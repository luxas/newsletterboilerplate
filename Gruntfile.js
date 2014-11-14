//
module.exports = function (grunt) {
	
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		uglify: {
			dev: {
				options: {
					compress: false,
					beautify: true,
					banner: "/*! <%= pkg.name %> - v<%= pkg.version %> - ' +'<%= grunt.template.today('yyyy-mm-dd') %> */"
				},
				files: {
					'public/js/home.min.js': ['src/js/home.js']
				}
			},
			dist: {
				options: {
					banner: "/*! <%= pkg.name %> - v<%= pkg.version %> - ' +'<%= grunt.template.today('yyyy-mm-dd') %> */"
				},
				files: {
					'public/js/home.min.js': ['src/js/home.js']
				}
			}
		},
		sass: {
			dev: {
				options: {
					style: "expanded",
					sourcemap: "none",
					banner: "/*! <%= pkg.name %> - v<%= pkg.version %> - ' +'<%= grunt.template.today('yyyy-mm-dd') %> */"
				},
				files: {
					'public/css/home.css': 'src/sass/home.scss'
				}
			},
			dist: {
				options: {
					style: "compressed",
					sourcemap: "none",
					banner: "/*! <%= pkg.name %> - v<%= pkg.version %> - ' +'<%= grunt.template.today('yyyy-mm-dd') %> */"
				},
				files: {
					'public/css/home.css': 'src/sass/home.scss'
				}
			}
		},
		imagemin: {
			dev: {
				files: [{
			        expand: true,                  		// Enable dynamic expansion
			        cwd: 'src/img/',                   	// Src matches are relative to this path
			        src: ['**/*.{png,jpg,gif}'],   		// Actual patterns to match
			        dest: 'public/img/'                 // Destination path prefix
			    }]
			},
			dist: {
				files: [{
			        expand: true,                  		// Enable dynamic expansion
			        cwd: 'src/img/',                   	// Src matches are relative to this path
			        src: ['**/*.{png,jpg,gif}'],   		// Actual patterns to match
			        dest: 'public/img/'                 // Destination path prefix
			    }]
			}
		},
		watch: {
			me: {
			    files: ['Gruntfile.js'],
			    options: {
			      reload: true
			    }
			},
			js:  {
				files: ["src/js/*.js"],
				tasks: ["uglify:dist"]
			},
			sass: {
				files: ["src/sass/*.scss"],
				tasks: ["sass:dist"]
			},
			img: {
				files: ["src/img/*.{png,jpg,gif}"], //This won't work
				tasks: ["imagemin:dist"]
			}
		}
	})


	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-imagemin');
	grunt.loadNpmTasks('grunt-contrib-watch');

	// this would be run by typing "grunt dev" on the command line
	grunt.registerTask('dev', ['uglify:dev', 'sass:dev', "imagemin:dev", "watch"]);

	// the default task can be run just by typing "grunt" on the command line
	grunt.registerTask('default', ['uglify:dist', 'sass:dist', "imagemin:dist", "watch"]);
}