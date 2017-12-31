const gulp = require('gulp');
const sass = require('gulp-sass');
const concat = require('gulp-concat');
const bubleify = require('bubleify');
const uglify = require('gulp-uglify');
const globby = require('globby');
const browserify = require('browserify');
const source = require('vinyl-source-stream');
const buffer = require('vinyl-buffer');
const through = require('through2');
const moduleImporter = require('node-sass-tilde-importer');
const watch = require('gulp-watch');
const prettify = require('gulp-pretty-data');

gulp.task('assets:css', () => {
    gulp.src('assets/css/*')
        .pipe(sass({
            outputStyle: 'compressed',
            importer: moduleImporter
        }))
        .pipe(concat('app.css'))
        .pipe(gulp.dest('static/css'));
});

gulp.task('assets:js', () => {
    var bundledStream = through();
    
    bundledStream
        .pipe(source('app.js'))
        .pipe(buffer())
        .pipe(uglify())
        .pipe(gulp.dest('static/js'));

    globby(['assets/js/*.js']).then(function(entries) {
        // create the Browserify instance.
        var b = browserify({
            entries: entries,
            debug: true,
            transform: [
                bubleify
            ]
        });
    
        // pipe the Browserify stream into the stream we created earlier
        // this starts our gulp pipeline.
        b.bundle().pipe(bundledStream);
        }).catch(function(err) {
        // ensure any errors from globby are handled
        bundledStream.emit('error', err);
    });

    return bundledStream;
    
});

gulp.task('minify:html', () => {
    gulp.src('public/**/*.{html,xml}')
        .pipe(prettify({
            type: 'minify',
            extensions: {
                'html': 'xml',
                'xml': 'xml'
            }
        }))
        .pipe(gulp.dest('public'));
})

gulp.task('minify', ['minify:html']);

gulp.task('assets:watch', ['assets:css', 'assets:js'], () => {
    gulp.watch('assets/css/*.scss', ['assets:css']);
    gulp.watch('assets/js/*.js', ['assets:js']);
})

gulp.task('assets', ['assets:css', 'assets:js']);