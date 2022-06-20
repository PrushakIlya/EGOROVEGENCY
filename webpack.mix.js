const mix = require('laravel-mix');

mix.sass('resources/sass/app.sass', 'public/app.css', {
  sassOptions: {
    outputStyle: 'compressed',
  },
});

mix.browserSync('http://localhost:8888');
