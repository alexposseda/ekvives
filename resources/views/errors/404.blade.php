<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://fonts.googleapis.com/css?family=Raleway:200,700,900" rel="stylesheet">
  <title>404 error</title>
</head>
<style>
@font-face {
  font-family: RalewayExtraLight;
  src: url({{asset("fonts/Raleway-ExtraLight.ttf")}});
}
* {
  margin: 0;
  padding: 0;
  box-sizing: inherit;
}
html {
  font-size: 50%;
  text-rendering: optimizeLegibility;
}
body {
  box-sizing: border-box;
  color: #fff;
  font-family: 'Raleway', sans-serif;
}
.container {
  background:linear-gradient(rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.4)), url({{asset("images/404/404.jpg")}}) no-repeat bottom;
  background-size: cover;
  height: 100vh;
  position: relative;
}
.text-box {
  position: absolute;
  top: 40%;
  left: 52%;
  transform: translate(-50%, -50%);
  text-align: center;
}
.text-box p:first-child {
  font-size: 52rem;
  font-weight: 900;
  letter-spacing: 3rem;
}
.text-box p:nth-child(2) {
  font-family: RalewayExtraLight;
  font-size: 8rem;
  font-weight: 200;
}
.text-box a:last-child {
  text-decoration: none;
  font-size: 2.4rem;
  font-weight: 700;
  color: #fff;
  padding: 20px 80px;
  border: 1px solid #fff;
  border-radius: 1rem;
  display: inline-block;
  margin-top: 5rem;
  position: relative;
}
.btn:after {
  content:"";
  display: inline-block;
  height: 100%;
  width: 100%;
  border: 1px solid #fff;
  border-radius: 1rem;
  position: absolute;
  top: 0;
  left: 0;
  transition: all .4s;
}
.btn:hover:after {
  transform: scaleX(1.4) scaleY(1.6);
  opacity: 0;
}

@media only screen and (max-width: 1023px) {
  html {
    font-size: 45%;
  }
}
@media only screen and (max-width: 767px) {
  html {
    font-size: 29%;
  }
}
@media only screen and (max-width: 480px) {
  html {
    font-size: 18%;
  }
}
</style>
<body>
<div class="container">
  <div class="text-box">
    <p>404</p>
    <p>грузчики ждут спецтехнику</p>
    <a href="/" class="btn" id="btn">Вернуться на сайт</a>
  </div>
</div>
</body>
</html>