var gulp = require('gulp');
var ts = require('gulp-typescript');
var browserSync = require('browser-sync').create();

const bases = {
    src: 'src/',
    dist: 'dist/'
};

gulp.task('browser-sync', function (done) {
    browserSync.init({
        server: {
            baseDir: bases.dist
        },
        notify: false
    });
    browserSync.watch('./dist/index.html').on('change', browserSync.reload);
    done()
});

gulp.task('copy-html', function () {
    return gulp.src([bases.src + '/*.html', bases.src + '**/**/*.php', bases.src + '**/**/*.html'])
        .pipe(gulp.dest(bases.dist));
});

gulp.task('typescript', function () {
    var tsResult = gulp.src('./src/**/javascript/js/*.ts')
        .pipe(ts({
            noImplicitAny: true
        }));
    return tsResult.js.pipe(gulp.dest(bases.dist));
});

gulp.task('default', gulp.series('typescript', 'copy-html', 'browser-sync', function (done) {
    gulp.watch(bases.src + '**/js/*.ts', gulp.series('typescript'));
    gulp.watch([bases.src + '/*.html', bases.src + '**/**/*.php', bases.src + '**/**/*.html'], gulp.series('copy-html'));
    done()
}));