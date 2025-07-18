import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

try {
  window.ClassicEditor = ClassicEditor;
} catch (e) {}

export { ClassicEditor };
