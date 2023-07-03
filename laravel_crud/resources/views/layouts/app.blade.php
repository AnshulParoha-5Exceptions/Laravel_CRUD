<!DOCTYPE html>
<html lang="en">
<head>
  <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>@yield('title')</title>
    <style>
      body {
          font-family: 'Merriweather', sans-serif;
      }
  </style>
    
</head>
<body>
    <div class="container">
      <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">
            <a href="/" style="color: black;"><i class="fa-solid fa-house fa-2xl"></i></a>


            <div class="row">
              @yield('search')
            </div>

          </div>
        </nav>
      </header>

      <section>
        @yield('content')
      </section>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $(document).ready(function() {
        $("#searchInput").on("keyup", function() {
          var searchTerm = $(this).val();
  
          $.ajax({
            url: "/products/search",
            method: "GET",
            data: { search: searchTerm },
            success: function(response) {
              $("table").html(response);
            },
            error: function(xhr, status, error) {
              console.error(error);
            }
          });
        });
      });
    </script>
</body>
</html>