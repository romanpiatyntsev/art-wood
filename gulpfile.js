var gulp = require('gulp'),
    notify = require('gulp-notify'),
    rename = require('gulp-rename'),
    plumber = require('gulp-plumber'),
    sourcemaps = require('gulp-sourcemaps'),
    concat = require('gulp-concat'),
    gulpif = require('gulp-if'),
    util = require('gulp-util'),
    // for BS4 sass
    sass = require('gulp-sass'),
    prefix = require('gulp-autoprefixer'),
    cssmin = require('gulp-cssnano'),
    ftp = require('vinyl-ftp');

// Set the browser that you want to support
var up = [
    'ie >= 11',
    'ie_mob >= 11',
    'ff >= 30',
    'chrome >= 34',
    'safari >= 8',
    'opera >= 23',
    'ios >= 9',
    'android >= 4.4',
    'bb >= 10'
];

var sassOptions = {
    outputStyle: 'expanded'
};

var onError = function(err) {
    notify.onError({
        title: "Gulp",
        subtitle: "Failure!",
        message: "Error: <%= error.message %>",
        sound: "Basso"
    })(err);
    this.emit('end');
};

var config = {
    srcGridDir: './node_modules/bootstrap-4-grid/scss/grid.scss',
    srcDir: './assets',
    srcDirPages: './assets/pages',
    stylePattern: '/**/*.+(scss)',
    sourceMaps: !util.env.production,
};

var user = util.env.FTP_USER;
var pwd = util.env.FTP_PASSWORD;

console.log(user);
console.log(pwd);

var localFiles = [ 'assets/css/**' ],
    remoteLocation = '/wp-content/themes/art/';

function getFtpConnection(){
    return ftp.create({
        host: 'gvozdyak.ftp.tools',
        port: 21,
        user: user,
        password: pwd,
        parallel: 5,
        log: util.log
    })
}

gulp.task('remote-deploy', function() {
    let conn = getFtpConnection();
    return gulp.src(localFiles, { base: '.', buffer: false } )
        .pipe( conn.dest(remoteLocation) )
});

var app = {};

app.addSassStyle = function(paths, outputFilename, dest) {
    return gulp.src(paths)
        .pipe(plumber({ errorHandler: onError }))
        .pipe(gulpif(config.sourceMaps, sourcemaps.init()))
        .pipe(sass(sassOptions))
        .pipe(prefix(up))
        .pipe(cssmin())
        .pipe(rename(outputFilename))
        .pipe(gulpif(config.sourceMaps, sourcemaps.write('.')))
        .pipe(gulp.dest(dest));
};

gulp.task('main', function(done) {
    app.addSassStyle([
        config.srcDir + '/sass/main.scss',
    ], 'main.min.css', config.srcDir + '/css/');
    done();
});

// BS4 grid
gulp.task('grid', function(done) {
    app.addSassStyle([
        config.srcDir + '/sass/grid.scss',
    ], 'grid.min.css', config.srcDir + '/css/');
    done();
});

gulp.task('watch', function(done) {
    gulp.watch(config.srcDir + config.stylePattern, gulp.series('main'));
    done();
});

gulp.task('default', gulp.series('watch'));

gulp.task('all', gulp.series('main', 'grid'));