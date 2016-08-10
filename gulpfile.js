var gulp			= require('gulp'),
	rename			= require('gulp-rename'),
	del				= require('del'),
	cleanCSS		= require('gulp-clean-css'),
	concat			= require('gulp-concat'),
	uglify			= require('gulp-uglify'),
	sass			= require('gulp-sass'),
	browserSync		= require('browser-sync').create(),
	autoprefixer 	= require('gulp-autoprefixer'),
	cache 			= require('gulp-cache'),
	imagemin 		= require('gulp-imagemin'),
	pngquant 		= require('imagemin-pngquant'),
	zip				= require('gulp-zip');
	//ftp 			= require('gulp-ftp');

var DEXbaseDir = "app",
	DEXdistDir = "build";

// var ftpSetting = {
// 	host: 'ftp.dreamschool.pro',
// 	user: 'dex@dreamschool.pro',
// 	pass: '2AYYnaHm',
// 	remotePath: '/dota2'
// };

gulp.task('libs-i', function() {
	gulp.src(DEXbaseDir + '/libs/font-awesome/fonts/*.*')
		.pipe(gulp.dest(DEXbaseDir + '/fonts'));

	gulp.src('vendor/iignatov/lightopenid/openid.php')
		.pipe(gulp.dest(DEXbaseDir + '/include/lightopenid'));
});

gulp.task('styles', function() {
	return gulp.src(DEXbaseDir + '/sass/*.sass')
		.pipe(sass({
			includePaths: require('node-bourbon').includePaths
		})
		.on('error', sass.logError))
		.pipe(rename({suffix: '.min', prefix : ''}))
		.pipe(autoprefixer({browsers: ['last 15 versions'], cascade: false}))
		//.pipe(cleanCSS())
		.pipe(gulp.dest(DEXbaseDir + '/css'));
});

gulp.task('scripts', function() {
	return gulp.src([
			DEXbaseDir + '/libs/bootstrap/dist/js/bootstrap.js',
			DEXbaseDir + '/libs/superfish/dist/js/superfish.js',
			DEXbaseDir + '/libs/owl.carousel/dist/owl.carousel.js',
			DEXbaseDir + '/libs/nanoscroller/bin/javascripts/jquery.nanoscroller.js',
			DEXbaseDir + '/libs/jquery-form-styler/jquery.formstyler.js',
			DEXbaseDir + '/libs/magnific-popup/dist/jquery.magnific-popup.js'
			// DEXbaseDir + '/libs/wysibb/jquery.wysibb.js'
			// DEXbaseDir + '/libs/jquery-pjax/jquery.pjax.js'
		])
		.pipe(concat('libs.min.js'))
		//.pipe(uglify())
		.pipe(gulp.dest(DEXbaseDir + '/js'));
});

gulp.task('browser-sync', ['styles', 'scripts'], function() {
	browserSync.init({
		proxy: 'localhost/DreamSchoolProject/app',
		notify: false
	});
});

// gulp.task('browser-sync', ['styles', 'scripts'], function() {
// 	browserSync.init({
// 		proxy: "http://localhost/DreamSchoolProject/app",
// 		notify: false
// 	});
// });

gulp.task('watch', function() {
	// gulp.watch(DEXbaseDir + '/sass/*.sass', ['styles']);
	// 	//.on('change', browserSync.reload);
	// 	//.on('change', ftp(ftpSetting));

	// // gulp.watch(DEXbaseDir + '/libs/**/*.js', ['scripts'])
	// // 	//.on('change', ftp(ftpSetting));
	// 	// .on('change', browserSync.reload);

	// gulp.watch(DEXbaseDir + '/js/*.js')
	// 	//.on('change', ftp(ftpSetting));
	// 	.on('change', browserSync.reload);

	// // gulp.watch(DEXbaseDir + '/**/*.php')
	// //  	//.on('change', ftp(ftpSetting));
	// //  	.on('change', browserSync.reload);

	//  gulp.watch(DEXbaseDir + '/css/*.css')
	//  	.on('change', browserSync.reload);

	 // gulp.watch(DEXbaseDir + '/libs/bootstrap/dist/css/*.css', ['styles'])
	 // 	.on('change', browserSync.reload);

	 gulp.watch(DEXbaseDir + '/sass/*.sass', ['styles']);

	 gulp.watch(DEXbaseDir + '/css/*.css')
	  	.on('change', browserSync.reload);

	gulp.watch(DEXbaseDir + '/libs/bootstrap/dist/css/*.css', ['styles'])
	  	.on('change', browserSync.reload);

	 gulp.watch(DEXbaseDir + '/template/**/*.php')
	 	.on('change', browserSync.reload);

	 gulp.watch(DEXbaseDir + '/view/*.php')
	 	.on('change', browserSync.reload);

	 gulp.watch(DEXbaseDir + '/model/*.php')
	 	.on('change', browserSync.reload);

	 gulp.watch(DEXbaseDir + '/controller/*.php')
	 	.on('change', browserSync.reload);

	 gulp.watch(DEXbaseDir + '/js/*.js')
	 	.on('change', browserSync.reload);
});

gulp.task('clean', function() {
	del([
		DEXdistDir + '/**/*',
		'!' + DEXdistDir + '/ftpsync.settings',
		'!' + DEXdistDir + '/configuration.php'
	]);
});

gulp.task('build', ['clean', 'libs-i', 'styles', 'scripts'], function() {
	gulp.src([
		'!' + DEXbaseDir + '/configuration.php',
		DEXbaseDir + '/*.php'
	])
	.pipe(gulp.dest(DEXdistDir));

	gulp.src(DEXbaseDir + '/.htaccess')
		.pipe(gulp.dest(DEXdistDir));

	gulp.src(DEXbaseDir + '/css/**/*')
		.pipe(cleanCSS())
		.pipe(gulp.dest(DEXdistDir + '/css'));

	gulp.src(DEXbaseDir + '/js/**/*')
		.pipe(uglify())
		.pipe(gulp.dest(DEXdistDir + '/js'));

	gulp.src(DEXbaseDir + '/images/**/*')
		.pipe(cache(imagemin({
			interlaced: true,
			progressive: true,
			svgoPlugins: [{removeViewBox: false}],
			use: [pngquant()]
		})))
		.pipe(gulp.dest(DEXdistDir + '/images'));

	gulp.src(DEXbaseDir + '/fonts/**/*')
		.pipe(gulp.dest(DEXdistDir + '/fonts'));

	gulp.src(DEXbaseDir + '/controller/**/*')
		.pipe(gulp.dest(DEXdistDir + '/controller'));

	gulp.src(DEXbaseDir + '/core/**/*')
		.pipe(gulp.dest(DEXdistDir + '/core'));

	gulp.src(DEXbaseDir + '/lang/**/*')
		.pipe(gulp.dest(DEXdistDir + '/lang'));

	gulp.src(DEXbaseDir + '/model/**/*')
		.pipe(gulp.dest(DEXdistDir + '/model'));

	gulp.src(DEXbaseDir + '/template/**/*')
		.pipe(gulp.dest(DEXdistDir + '/template'));

	gulp.src(DEXbaseDir + '/view/**/*')
		.pipe(gulp.dest(DEXdistDir + '/view'));

	gulp.src(DEXbaseDir + '/include/**/*')
		.pipe(gulp.dest(DEXdistDir + '/include'));
});

gulp.task('pak', function() {
	gulp.src(DEXdistDir + '/**/*')
		.pipe(zip('build.zip'))
		.pipe(gulp.dest(DEXdistDir));
});

gulp.task('default', ['libs-i', 'browser-sync', 'watch']);