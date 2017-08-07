const gulp = require("gulp");
const gulpCompass = require("gulp-compass");
const gulpRev = require("gulp-rev");
const gulpWatch = require("gulp-watch");

gulp.task("compass:dev", function() {
    return gulp.src("./scss/*.scss")
        .pipe(gulpCompass({
            css: "../build/css",
            sass: "scss",
            logging: false,
            sourcemap: true,
            style: "nested"
        }))
        .pipe(gulp.dest("../build/css"));
});

gulp.task("compass:prod", function() {
    return gulp.src("./scss/*.scss")
        .pipe(gulpCompass({
            css: "../build/css",
            sass: "scss",
            logging: false,
            sourcemap: false,
            style: "compressed"
        }))
        .pipe(gulp.dest("../build/css"));
});

gulp.task("rev:prod", ["compass:prod"], () => {
    return gulp.src(["../build/css/*.css"], {base: "../build"})
        .pipe(gulpRev())
        .pipe(gulp.dest(".."))
        .pipe(gulpRev.manifest())
        .pipe(gulp.dest(".."));
});

gulp.task("watch", ["compass:dev"], () => {
    gulp.watch('scss/**/*.scss', ["compass:dev"]);
});

gulp.task("build:dev", ["compass:dev"]);
gulp.task("build:prod", ["rev:prod"]);
