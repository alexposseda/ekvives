@if ($crud->hasAccess('update'))
	@if (!$crud->model->translationEnabled())

	<!-- Single edit button -->
	<a href="{{ url($crud->route.'/'.$entry->getKey().'/edit') }}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> {{ trans('backpack::crud.edit') }}</a>

	@else

	<!-- Edit button group -->
	<div class="btn-group">
	  <a href="{{ url($crud->route.'/'.$entry->getKey().'/edit') }}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> {{ trans('backpack::crud.edit') }}</a>
	  <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    <span class="caret"></span>
	    <span class="sr-only">Toggle Dropdown</span>
	  </button>
		<ul class="dropdown-menu dropdown-menu-right">
			<li class="dropdown-header">{{ trans('backpack::crud.edit_translations') }}:</li>
			<li><a href="/setlocale/en">English</a></li>
			<li><a href="/setlocale/ru">Русский</a></li>
			<li><a href="/setlocale/ua">Украинский</a></li>
		</ul>
	</div>

	@endif
@endif