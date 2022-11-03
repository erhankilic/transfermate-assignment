<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Books</title>
  <link href="style.css" rel="stylesheet">
  <script type="text/javascript" src="core.js"></script>
</head>

<body>
  <div class="container">
    <header>
      <h1>Books</h1>
    </header>
    <main>
      <div class="filter-container">
        <div class="col">
          <input type="text" id="author-name" name="author_name" placeholder="Search Author..." />
        </div>
        <div class="col">
          <button type="button" id="filter-button">Filter</button>
        </div>
      </div>
      <div class="books-container">
        <div class="books-header">
          <div class="col">Author</div>
          <div class="col">Book</div>
        </div>
        <div id="books">
        </div>
      </div>
    </main>
  </div>
</body>

</html>