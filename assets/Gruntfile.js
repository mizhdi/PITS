module.exports = function (grunt) {

	grunt.initConfig({

		pkg: grunt.file.readJSON('package.json'),


		// nested, expanded, compact, compressed
		sass: {
			dist: {
				options: {
					style: 'compressed', 
					banner: '/*! <%= pkg.name %> - v<%= pkg.version %> - ' + 
							'<%= grunt.template.today("yyyy-mm-dd") %> - <%= pkg.author %>*/'
				},
				
				files: {
					// 'css/pink.css' : 'sass/main.scss'
					// 'css/orange.css' : 'sass/main.scss'
					  // 'css/green.css' : 'sass/main.scss'
					// 'css/lime.css' : 'sass/main.scss'
					// 'css/blue.css' : 'sass/main.scss'
					// 'css/brown.css' : 'sass/main.scss'
					// 'css/grey.css' : 'sass/main.scss'
					'css/black.css' : 'sass/main.scss'
				}
			}

		},

		requirejs: {
			compile: {
				options: {
				  baseUrl: "js",
				  mainConfigFile: "js/app.js",
				  name: "app", // assumes a production build using almond
				  out: "js/main.js"
				}
			}
		},

		watch: {

			css: {
				files: ['**/*.scss'],
				tasks: ['sass']
			},

			scripts: {
				files: ['js/*.js'],
				tasks: ['requirejs']
			}

			// livereload: {
			// 	options: { livereload: 32729 },
			// 	files: ['**/*']
			// }
		}


	});

    grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-requirejs');
 
    // Default task.
    grunt.registerTask('default', ['watch']);

}