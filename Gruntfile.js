'use strict';
module.exports = function(grunt) {

	// load all tasks
	require('load-grunt-tasks')(grunt, {scope: 'devDependencies'});

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		watch: {
			scripts: {
				files: ['js/app/*.js'],
				tasks: ['concat', 'uglify:app'],
				options: {
				  spawn: false,
				},
			},
			sass: {
				files: ['scss/*.scss'],
				tasks: ['css'],
				options: {
				  spawn: false,
				  livereload: true,
				},
			},
		},
		sass: {                              // Task
		    default: {                            // Target
		    	options: {                       // Target options
					style: 'expanded'
		    	},
		    	files: {                         // Dictionary of files
					'style.css': 'scss/style.scss',       // 'destination': 'source'
		    	}
		    }
		  },
		postcss: {
			options: {
				map: true, // inline sourcemaps

				processors: [
				require('pixrem')(), // add fallbacks for rem units
				require('autoprefixer')({browsers: 'last 2 versions'}), // add vendor prefixes
				require('cssnano')() // minify the result
				]
			},
			files: {
					'style.css':'style.css'
			}
		},
		cssmin: {
			options: {
				aggressiveMerging : false
			},
			target: {
				files: {
					'style.min.css': 'style.css'
				}
			}
		},
		concat: {
			release: {
				src: [
					'js/app/**.js'
				],
				dest: 'js/development.js',
			}
		},
		uglify: {
			options: {
				extDot: 'last',
				mangle: {
					except: ['jQuery', 'sidr', 'fastClick', 'fitVids']
				},
				drop_console: true
			},
			vendors: {
				files: {
					'js/vendors/jquery.fastclick.min.js' : 'js/vendors/fastclick.js',
					'js/vendors/jquery.fitvids.min.js' : 'js/vendors/jquery.fitvids.js',
					'js/vendors/jquery.sidr.min.js' : 'js/vendors/sidr.js',
				}
			},
			app: {
				files: {
					'js/production.min.js' : 'js/development.js',
				}
			},
		},
		// https://www.npmjs.org/package/grunt-wp-i18n
		makepot: {
			target: {
				options: {
					domainPath: 'languages/',
					potFilename: '<%= pkg.name %>.pot',
					potHeaders: {
					poedit: true, // Includes common Poedit headers.
					'x-poedit-keywordslist': true // Include a list of all possible gettext functions.
				},
				type: 'wp-theme',
				updateTimestamp: false,
				processPot: function( pot, options ) {
					pot.headers['report-msgid-bugs-to'] = 'https://kathyisawesome.com/contact';
					pot.headers['language'] = 'en_US';
					return pot;
					}
				}
			}
		},
		replace: {
			styleVersion: {
				src: [
					'scss/style.scss',
					'style.css'
				],
				overwrite: true,
				replacements: [{
					from: /Version:.*$/m,
					to: 'Version: <%= pkg.version %>'
				}]
			},
			functionsVersion: {
				src: [
					'functions.php'
				],
				overwrite: true,
				replacements: [ {
					from: /^define\( 'FL_CHILD_VERSION'.*$/m,
					to: 'define( \'FL_CHILD_VERSION\', \'<%= pkg.version %>\' );'
				} ]
			},
		},
		cssjanus: {
			theme: {
				options: {
					swapLtrRtlInUrl: false
				},
				files: [
					{
						src: 'style.css',
						dest: 'style-rtl.css'
					},
					{
						src: 'style.min.css',
						dest: 'style-rtl.min.css'
					},
				]
			}
		},
		wp_readme_to_markdown: {
			your_target: {
				files: {
					'readme.md': 'readme.txt'
				},
			},
		},
	});

	grunt.registerTask( 'default', [
		'sass',
		'postcss',
		'cssmin'
	]);

	grunt.registerTask( 'docs', [
		'wp_readme_to_markdown'
	]);
	
	grunt.registerTask( 'css', [
		'sass', 'postcss', 'cssmin'
	]);


	grunt.registerTask( 'build', [
		'replace',
		'sass',
		'postcss',
		'cssmin',
		'concat:release',
		'uglify:app',
		'makepot',
		'cssjanus'
	]);

};
