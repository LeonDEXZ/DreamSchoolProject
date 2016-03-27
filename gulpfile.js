var gulp			= require('gulp'),
	rename			= require('gulp-rename'),
	del				= require('del'),
	cleanCSS		= require('gulp-clean-css'),
	concat			= require('gulp-concat'),
	uglify			= require('gulp-uglify'),
	sass			= require('gulp-sass'),
	browserSync		= require('browser-sync').create(),
	autoprefixer 	= require('gulp-autoprefixer');

var baseDir = "app",
	distDir = "build";

gulp.task('styles', function() {
	return gulp.src(baseDir + '/sass/*.sass')
		.pipe(sass({
			includePaths: require('node-bourbon').includePaths
		}).on('error', sass.logError))
		.pipe(rename({suffix: '.min', prefix : ''}))
		.pipe(autoprefixer({browsers: ['last 15 versions'], cascade: false}))
		// .pipe(cleanCSS())
		.pipe(gulp.dest(baseDir + '/css'))
		.pipe(browserSync.stream());
});

gulp.task('libs-i', function() {
	 // font-awesome
	 //gulp.src(baseDir + '/libs/font-awesome/scss/*.scss')
	 //	.pipe(gulp.dest(baseDir + '/sass/font-awesome'));

	gulp.src(baseDir + '/libs/font-awesome/fonts/*.*')
		.pipe(gulp.dest(baseDir + '/fonts'));

	// bootstrap
	gulp.src(baseDir + '/libs/bootstrap/dist/css/bootstrap.min.css')
		.pipe(gulp.dest(baseDir + '/css'));

	// superfish
	// gulp.src(baseDir + '/libs/superfish/dist/css/superfish.css')
	// 	.pipe(cleanCSS())
	// 	.pipe(rename({suffix: '.min', prefix : ''}))
	// 	.pipe(gulp.dest(baseDir + '/css'));
});

gulp.task('scripts', function() {
	return gulp.src([
			baseDir + '/libs/jquery/dist/jquery.min.js',
			baseDir + '/libs/bootstrap/dist/js/bootstrap.min.js',
			baseDir + '/libs/superfish/dist/js/superfish.min.js'
		])
		.pipe(concat('libs.min.js'))
		.pipe(uglify())
		.pipe(gulp.dest(baseDir + '/js'));
});

gulp.task('browser-sync', ['styles', 'scripts'], function() {
	browserSync.init({
		server: {
			baseDir: baseDir
		},
		notify: false
	});
});

gulp.task('watch', function() {
	gulp.watch(baseDir + '/sass/*.sass', ['styles']);
	gulp.watch(baseDir + '/libs/**/*.js', ['scripts']);
	gulp.watch(baseDir + '/js/*.js').on("change", browserSync.reload);
	gulp.watch(baseDir + '/*.html').on('change', browserSync.reload);
});

gulp.task('clean', function() {
	del([
		distDir + '/css/*.css',
		distDir + '/index.html',
		distDir + '/js/*.js'
	]);
});

// TODO 
gulp.task('build', ['clean', 'styles', 'scripts'], function() {

	gulp.src(baseDir + '/css/*.css')
		.pipe(gulp.dest(distDir + '/css'));

	gulp.src(baseDir + '/*.html')
		.pipe(gulp.dest(distDir));

	gulp.src(baseDir + '/js/*.js')
		.pipe(gulp.dest(distDir + '/js'));	
});

gulp.task('default', ['libs-i', 'browser-sync', 'watch']);