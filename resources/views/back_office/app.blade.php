<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=0"
    />
    <title>@yield('title')</title>
    <!-- {# Dashboard - Links #} -->
    @include('back_office.partials.styles')
    <!-- {# Fin Dashbord Link #} -->
  </head>

  <body>
    <!-- {# Main wrapper #} -->
    <div class="main-wrapper " style="margin-top:80px;">

      <!-- {# Debut Header #} -->
     @include('back_office.partials.header')
      <!-- {# Fin Header #} 

      {# ------------------ #}

      {# Debut Sidebar #} -->

      @include('back_office.partials.sidebar')
      
      <!-- {# Fin Sidebar #} 
      
      {# --------------------- #}
      
      {# Contenu de la page #} -->
      <div class="page-wrapper">
          <div class="page-header">
            @yield('dashboard-header')
          </div>
        <div class="content container-fluid">
          @yield('dashboard-content')
        </div>

      </div>
      <!-- {# Fin Contenu de la page #} -->
    </div>
    <!-- {# Scripts dashboard #} -->
    @include('back_office.partials.scripts')
    <!-- {# Fin Script Dashboard #} -->
    @if (session()->get('error'))
    <script>
      iziToast.error({
        title:"erreur",
        position:"topRight",
        message:"{{session()->get('error')}}"
      });
    </script>
     @endif
     @if (session()->get('success'))
    <script>
      iziToast.success({
        title:"success",
        position:"topRight",
        message:"{{session()->get('success')}}"
      });
    </script>
     @endif
  </body>
 
 
</html>
