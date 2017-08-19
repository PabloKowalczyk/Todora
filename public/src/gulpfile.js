const gulp = require("gulp");
const gulpCompass = require("gulp-compass");
const gulpRev = require("gulp-rev");
const gulpWatch = require("gulp-watch");
const gulpLiveReload = require("gulp-livereload");

gulp.task("compass:dev", function() {
    return gulp.src("./scss/*.scss")
        .pipe(gulpCompass({
            css: "../build/css",
            sass: "scss",
            logging: false,
            sourcemap: true,
            style: "nested"
        }))
        .pipe(gulp.dest("../build/css"))
        .pipe(gulpLiveReload());
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

gulp.task("rev:prod", ["compass:prod", "svg:prod", "favicon"], () => {
    return gulp.src(["../build/**/*"], {base: "../build"})
        .pipe(gulpRev())
        .pipe(gulp.dest(".."))
        .pipe(gulpRev.manifest())
        .pipe(gulp.dest(".."));
});

gulp.task("svg:dev", () => {
    "use strict";

    return gulp.src("svg/**/*.svg")
        .pipe(gulp.dest("../build/svg"));
});

gulp.task("favicon", () => {
    "use strict";

    return gulp.src("favicon/*")
        .pipe(gulp.dest("../build/favicon"));
});

gulp.task("svg:prod", () => {
    "use strict";

    return gulp.src("svg/**/*.svg")
        .pipe(gulp.dest("../build/svg"));
});

gulp.task("watch", ["compass:dev", "svg:dev", "favicon"], () => {
    gulpLiveReload.listen({quiet:true});

    gulp.watch('scss/**/*.scss', ["compass:dev"]);
});

gulp.task("build:dev", ["compass:dev", "svg:dev", "favicon"]);
gulp.task("build:prod", ["rev:prod"]);
