var gulp			= require('gulp'),
	rename			= require('gulp-rename'),
	del				= require('del'),
	cleanCSS		= require('gulp-clean-css'),
	concat			= require('gulp-concat'),
	uglify			= require('gulp-uglify'),
	sass			= require('gulp-sass'),
	browserSync		= require('browser-sync').create(),
	autoprefixer 	= require('gulp-autoprefixer');

var DEXbaseDir = "app",
	DEXdistDir = "build";

gulp.task('styles', function() {
	return gulp.src(DEXbaseDir + '/sass/*.sass')
		.pipe(sass({
			includePaths: require('node-bourbon').includePaths
		}).on('error', sass.logError))
		.pipe(rename({suffix: '.min', prefix : ''}))
		.pipe(autoprefixer({browsers: ['last 15 versions'], cascade: false}))
		// .pipe(cleanCSS())
		.pipe(gulp.dest(DEXbaseDir + '/css'))
		.pipe(browserSync.stream());
});

gulp.task('libs-i', function() {
	 // font-awesome
	 //gulp.src(DEXbaseDir + '/libs/font-awesome/scss/*.scss')
	 //	.pipe(gulp.dest(DEXbaseDir + '/sass/font-awesome'));

	gulp.src(DEXbaseDir + '/libs/font-awesome/fonts/*.*')
		.pipe(gulp.dest(DEXbaseDir + '/fonts'));

	// bootstrap
	gulp.src(DEXbaseDir + '/libs/bootstrap/dist/css/bootstrap.min.css')
		.pipe(gulp.dest(DEXbaseDir + '/css'));

	// superfish
	// gulp.src(DEXbaseDir + '/libs/superfish/dist/css/superfish.css')
	// 	.pipe(cleanCSS())
	// 	.pipe(rename({suffix: '.min', prefix : ''}))
	// 	.pipe(gulp.dest(DEXbaseDir + '/css'));
});

gulp.task('scripts', function() {
	return gulp.src([
			DEXbaseDir + '/libs/jquery/dist/jquery.min.js',
			DEXbaseDir + '/libs/bootstrap/dist/js/bootstrap.min.js',
			DEXbaseDir + '/libs/superfish/dist/js/superfish.min.js',
			DEXbaseDir + '/libs/owl.carousel/dist/owl.carousel.min.js'
		])
		.pipe(concat('libs.min.js'))
		.pipe(uglify())
		.pipe(gulp.dest(DEXbaseDir + '/js'));
});

gulp.task('browser-sync', ['styles', 'scripts'], function() {
	browserSync.init({
		server: {
			baseDir: DEXbaseDir
		},
		notify: false
	});
});

gulp.task('watch', function() {
	gulp.watch(DEXbaseDir + '/sass/*.sass', ['styles']);
	gulp.watch(DEXbaseDir + '/libs/**/*.js', ['scripts']);
	gulp.watch(DEXbaseDir + '/js/*.js').on("change", browserSync.reload);
	gulp.watch(DEXbaseDir + '/*.html').on('change', browserSync.reload);
});

gulp.task('clean', function() {
	del([
		DEXdistDir + "/css",
		DEXdistDir + '/index.html',
		DEXdistDir + '/js',
		DEXdistDir + '/fonts',
		DEXdistDir + '/images',
		DEXdistDir + '/build.zip'
	]);
});

// TODO 
gulp.task('build', ['clean', 'libs-i', 'styles', 'scripts'], function() {
	gulp.src(DEXbaseDir + '/*.html')
		.pipe(gulp.dest(DEXdistDir));

	gulp.src(DEXbaseDir + '/css/**/*')
		.pipe(gulp.dest(DEXdistDir + '/css'));

	gulp.src(DEXbaseDir + '/js/**/*')
		.pipe(gulp.dest(DEXdistDir + '/js'));

	gulp.src(DEXbaseDir + '/images/**/*')
		.pipe(gulp.dest(DEXdistDir + '/images'));

	gulp.src(DEXbaseDir + '/fonts/**/*')
		.pipe(gulp.dest(DEXdistDir + '/fonts'));
});

gulp.task('default', ['libs-i', 'browser-sync', 'watch']);