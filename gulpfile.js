var gulp = require("gulp");
var sass = require("gulp-sass");
var sassGlob = require("gulp-sass-glob");
var browserify = require("browserify");
var browserSync = require("browser-sync").create();
var source = require("vinyl-source-stream");

gulp.task("default", function() {
  return gulp
    .src("./scss/*.scss")
    .pipe(sassGlob())
    .pipe(sass())
    .pipe(gulp.dest("./css"));
});

gulp.task("build", function() {
  browserify({
    entries: ["src/app.js"] // ビルド元のファイルを指定
  })
    .bundle()
    .pipe(source("bundle.js")) // 出力ファイル名を指定
    .pipe(gulp.dest("dist/")); // 出力ディレクトリを指定
});
gulp.task("browser-sync", function() {
  browserSync.init({
    server: {
      baseDir: "./", // 対象ディレクトリ
      index: "index.html" //indexファイル名
    }
  });
});
gulp.task("bs-reload", function() {
  browserSync.reload();
});

// Gulpを使ったファイルの監視
gulp.task("default", ["build", "browser-sync"], function() {
  gulp.watch("./scss/*.scss", gulp.task("sass"));
  gulp.watch("./src/*.js", gulp.task("build"));
  gulp.watch("./*.html", gulp.task("bs-reload"));
  gulp.watch("./dist/*.+(js|css)", gulp.task("bs-reload"));
});
