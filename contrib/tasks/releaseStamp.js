var crypto = require('crypto');

module.exports = function(grunt) {

	grunt.registerTask('releaseStamp', 'Creates a release file with a version.', function() {
		var stamp, hash, time, out;

		time = 'build_' + (new Date().getTime());

		hash = crypto.createHash('md5');
		hash.update(time);
		stamp = hash.digest('hex');

		out = grunt.config('releaseStamp.out') || 'release.txt';

		grunt.file.write(out, stamp);
	});

};
