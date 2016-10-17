// Watch all tasks in gulpfile
const gulp = require('gulp');
const organiser = require('gulp-organiser');

module.exports = organiser.register((task, allTasks) => {
  gulp.task(task.name, () => {
    allTasks.forEach(t => {
      const watchedFiles = t.tasks[0].watch || t.tasks[0].src;
      console.log(`watching ${t.name}: ${watchedFiles}`);
      gulp.watch(watchedFiles, [t.name]);
    });
  });
});
