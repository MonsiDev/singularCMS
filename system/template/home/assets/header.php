<html>
  <head>
    <?php get_meta(); ?>
    <title><?php site_title(); ?></title>
    <link rel="stylesheet" href="/content/css/bootstrap.min.css">
  </head>
  <body>
    <header>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">Оазис КМВ</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="/home/view?type=object">Объекты</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/home/view?type=type">Типы</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/home/view?type=category">Категории</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/home/view?type=user">Пользователи</a>
            </li>
            <li class="nav-item">
              <a href="/home/add?type=object" class="btn btn-outline-success" role="button" aria-pressed="true">Добавить</a>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0" action="/home/search">
            <input class="form-control mr-sm-2" name="id" type="search" placeholder="ID объекта" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Поиск</button>
          </form>
        </div>
      </nav>
    </header>
    <main>
