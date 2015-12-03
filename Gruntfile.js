module.exports = function(grunt) {
  grunt.initConfig({
    /**
     * The general watch task
     */
    watch: {
      test: {
        files: [
          "app/**/*.php",
          "tests/**/*"
        ],
        tasks: ['clear','phplint','phpcs','phpunit']
      }
    },

    /**
     * PHPUnit tester
     */
    phpunit: {
      classes: {
        dir: 'tests/'
      },
      options: {
        bin: 'vendor/bin/phpunit',
        color: true,
        configuration: 'phpunit.xml',
        coverageHtml: 'coverage',
        followOutput: true,
        testSuffix: '.test.php'
      }
    },

    /**
     *
     */
    phplint: {
      all: [
        'app/**/*.php',
        'tests/**/*.test.php',
        'tests/**/*.php'
      ],
      options: {
        swapPath: '/tmp'
      }
    },

    /**
     *
     */
    phpcs: {
      application: {
        src: [
          "app/**/*.php",
          "tests/**/*"
        ]
      },
      options: {
        standard: 'vendor/fuegas/vanilla-psr/vanilla-psr.xml',
        extensions: 'php'
      }
    },
  });

  /**
   *
   */
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-phpunit');
  grunt.loadNpmTasks('grunt-phplint');
  grunt.loadNpmTasks('grunt-phpcs');
  grunt.loadNpmTasks('grunt-clear');

  grunt.registerTask('default', ['watch']);
};
