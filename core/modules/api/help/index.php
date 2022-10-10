<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"></link>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"></link>
    <link rel="stylesheet" href="https://cdn.rawgit.com/rikmms/progress-bar-4-axios/0a3acf92/dist/nprogress.css"></link>
    <link rel="stylesheet" href="./core/modules/api/help/style.css">
  </head>
  <body>
    
    <div class="app" id="app">
      <nav id="menu" v-if="navOpen" :class="{'is-opened': navOpen}">
        <header v-if="navOpen">
          <h5 class="pt-3">Opciones</h5>
        </header>
        <section>
          <ul class="list-unstyled">
            <li class="list-item">
              <i class="fa fa-home"> </i>
              <router-link to="/" title="Inicio">
              Paginas
              </router-link>
            </li>
            <li class="list-item">
              <i class="fa fa-image"> </i>
              <router-link to="/images" title="Imagenes">
              Imagenes
              </router-link>
            </li>
            <li class="list-item">
              <i class="fa fa-book" > </i>
              <router-link to="/manifest" title="Manifiesto">
              Manifiesto
              </router-link>
            </li>
            <li class="list-item">
              <i class="fa fa-sitemap"> </i>
              <router-link to="/sitemap" title="Sitemap">
              Sitemap
              </router-link>
            </li>
          </ul>
        </section>
        <footer class="footer text-center">
          <p><small>Copyright © 2019</small></p>
        </footer>
      </nav>
      <main id="wrapper"  :class="{'menu-is-open': navOpen}">
        <header id="header">
          <button @click="toogleMenu">
          <span v-if="navOpen" class="fa fa-arrow-left"></span>
          <span v-else="navOpen" class="fa fa-bars"></span>
          </button>
          <h2 class="text-deco-none">Barrio CMS Api test</h2>
          <div class="right">
            <a href="./" class="btn">
              <i class="fa fa-external-link"></i>
            </a>
          </div>
        </header>
        <section id="content">
          <div class="container">
            <div class="row">
              <div class="col-md-12 mt-4">
                <transition name="fade" mode="out-in">
                  <router-view></router-view>
                </transition>
              </div>
            </div>
          </div>
        </section>
      </main>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.17/vue.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-router/3.1.3/vue-router.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
    <script src="https://cdn.rawgit.com/rikmms/progress-bar-4-axios/0a3acf92/dist/index.js"></script>
    <script src="https://webmaker.app/app/lib/transpilers/babel-polyfill.min.js"></script>
    <script src="./core/modules/api/help/index.js"></script>
  </body>
</html>