const Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())

    // uncomment to define the assets of the project
    .addEntry('js/vendor/bootstrap', './assets/js/bootstrap.js')
    .addStyleEntry('css/todora', './assets/scss/todora.scss')
    .addStyleEntry('css/vendor/bootstrap', './assets/scss/bootstrap.scss')
    .enableSassLoader()

    // uncomment for legacy applications that require $/jQuery as a global variable
    .autoProvidejQuery()
;

module.exports = Encore.getWebpackConfig();
