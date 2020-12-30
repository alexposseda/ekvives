@push('crud_fields_styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.css" integrity="sha256-e47xOkXs1JXFbjjpoRr1/LhVcqSzRmGmPqsrUQeVs+g=" crossorigin="anonymous" />
    <style>
        #dropzone {
            margin-bottom: 3rem;
        }
        .dropzone {
            border: 2px dashed #0087F7;
            border-radius: 5px;
            background: white;
        }
        .save_dropzone_photos {
            margin-left: 43%;
            cursor: pointer;
            display: none;
            color: black;
        }
    </style>
@endpush

<div class="upload-dropzone-table col-md-12">
    <div class="form-group col-md-12">
        <strong>{{ $field['label'] }}</strong>
    </div>
    <div @include('crud::inc.field_wrapper_attributes') >
        <div id="{{ $field['name'] }}-existing" class="dropzone dropzone-previews">
            @if (isset($field['value']) && count($field['value']))
                @foreach($field['value'] as $key => $file_path)
                    <div class="dz-preview dz-image-preview dz-complete">
                        <input type="hidden" name="{{ $field['name'] }}[]" value="{{ $file_path }}" />
                        <div class="dz-image-no-hover">
                            <img style="width:178px" src="{{ $file_path }}"/>
                        </div>
                        <a class="dz-remove" data-remove="{{ $key }}" data-path="{{ $file_path }}">{{ trans('backpack::dropzone.remove_file') }}</a>
                    </div>
                @endforeach
            @endif
        </div>
        <div id="{{ $field['name'] }}-dropzone" class="dropzone dropzone-target"></div>
        <div id="{{ $field['name'] }}-hidden-input" class="hidden"></div>
    </div>
    <button id="save_dropzone_photos" class="save_dropzone_photos">
        <span class="fa fa-save"></span>&nbsp;<span>Сохранить фото</span>
    </button>
</div>

@push('crud_fields_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.js" integrity="sha256-eO9VTVeZLaplH86Iwt8l39+l7GZpLOTsVWYziS5oY0Q=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.6.0/Sortable.min.js" integrity="sha256-ncVUo40HSaxFORNNlffKfkkhbsUHNLAzQ2SFlRUw7gA=" crossorigin="anonymous"></script>
    <script>
        Dropzone.autoDiscover = false;
        $("div#{{ $field['name'] }}-dropzone").dropzone({
            {{-- url: "{{ url($crud->route.'/'.$entry->id.'/'.$field['uploadRoute']) }}", --}}
            url: "{{ $field['uploadRoute'] }}",
            maxFilesize: {{ $field['maxFilesize'] }},
            acceptedFiles: "{{ $field['acceptedFiles'] }}",
            paramName: "file",
            autoProcessQueue: false,
            parallelUploads : 100,
            addRemoveLinks: true,
            previewsContainer: "div#{{ $field['name'] }}-existing",
            hiddenInputContainer: "div#{{ $field['name'] }}-hidden-input",
            previewTemplate: '<div class="dz-preview dz-file-preview"> <input type="hidden" name="{{$field['name']}}[]" class="dropzone-filename-field"/> <div class="dz-image"><img data-dz-thumbnail/></div><div class="dz-details"> <div class="dz-size"><span data-dz-size></span></div><div class="dz-filename"><span data-dz-name></span></div></div><div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div><div class="dz-error-message"><span data-dz-errormessage></span></div><div class="dz-success-mark"><span>✔</span></div><div class="dz-error-mark"><span>✘</span></div><div class="dz-error-message"><span data-dz-errormessage></span></div></div>',
            headers: {
                'X-CSRF-Token': '{{ csrf_token() }}'
            },
            sending: function(file, xhr, formData) {
                formData.append("_token", $('[name=_token').val());
                formData.append("id", {{ isset($entry) ? $entry->id : 1 }});
            },
            init: function() {
                var thisDropzone = this;
                var submitButton = document.querySelector("#save_dropzone_photos");

                this.on("addedfile", function(file) {
                    $("#save_dropzone_photos").css("display", "block");
                });

                submitButton.addEventListener("click", function(e) {
                    if(thisDropzone.getQueuedFiles().length > 0) {
                        event.preventDefault();
                        thisDropzone.processQueue();
                    }
                });
            },
            error: function(file, response) {
                $(file.previewElement).find('.dz-error-message').remove();
                $(file.previewElement).remove();

                $(function(){
                    new PNotify({
                        title: file.name+" was not uploaded!",
                        text: response,
                        type: "error",
                        icon: false
                    });
                });
            },
            success: function (file, response, request) {
                if (response.success) {
                    console.log('success');
                    $(file.previewElement).find('.dropzone-filename-field').val(response.filename);
                }
            },
        });
        var el = document.getElementById('{{ $field['name'] }}-existing');

        var sortable = new Sortable(el, {
            group: "{{ $field['name'] }}-sortable",
            handle: ".dz-preview",
            draggable: ".dz-preview",
            scroll: true,
        });

        $('.dz-remove').click(function (e) {
            e.preventDefault();
            e.stopPropagation();
            console.log($(this).data());
            var image_id = $(this).data('remove');
            var image_path = $(this).data('path');

            $.ajax({
                {{-- url: '{{ url($crud->route.'/'.$entry->id.'/'.$field['deleteRoute']) }}', --}}
                url: '{{ $field['deleteRoute'] }}',
                type: 'POST',
                data: {
                    entry_id: {{ isset($entry) ? $entry->id : 1 }},
                    image_id: image_id,
                    image_path: image_path
                }
            })

                .done(function(status) {
                    var notification_type;

                    if (status.success) {
                        notification_type = 'success';
                        $('div.dz-preview[data-id="'+image_id+'"]').remove();
                    } else {
                        notification_type = 'error';
                    }

                    new PNotify({
                        text: status.message,
                        type: notification_type,
                        icon: false
                    });
                });

            $(this).closest('.dz-preview').remove();
        });
    </script>
@endpush