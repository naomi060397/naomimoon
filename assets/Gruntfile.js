module.exports = function(grunt) {
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		sass: {
			dev: {    // indicates that it will be used only during development
			  files: {
				// destination     // source file
				'build/css/all.css': 'src/css/all.scss',
				'build/css/admin.css': 'src/css/admin.scss',
				'build/css/fonts/font-nunito.css': 'src/css/fonts/font-nunito.scss',
				'build/css/fonts/font-roboto.css': 'src/css/fonts/font-roboto.scss',
				'build/css/fonts/font-ubuntu.css': 'src/css/fonts/font-ubuntu.scss'
			  }
			}
		},
		uglify: {
			dev: {
				files: [{
					expand: true,
					cwd: 'src/js',
					src: '**/*.js',
					dest: 'build/js'
				  }]
			}
		},
		watch: {
			sass: {
				files: '**/*.scss', // ** any directory; * any file
				tasks: ['sass']
			},
			js: {
				files: '**/*.js', // ** any directory; * any file
				tasks: ['uglify']
			}
		},
	});
	//grunt.registerTask('default', ['sass'] );
};
