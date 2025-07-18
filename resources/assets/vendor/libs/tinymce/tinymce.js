import Tinymce from "tinymce/tinymce";
import 'tinymce/themes/silver';
import 'tinymce/models/dom/model';
import 'tinymce/icons/default/icons';
import 'tinymce/skins/content/default/content';
import 'tinymce/skins/ui/oxide/content';
import 'tinymce/skins/ui/oxide/skin';
import 'tinymce/plugins/accordion/plugin';
import 'tinymce/plugins/advlist/plugin';
import 'tinymce/plugins/anchor/plugin';
import 'tinymce/plugins/autolink/plugin';
import 'tinymce/plugins/autoresize/plugin';
import 'tinymce/plugins/autosave/plugin';
import 'tinymce/plugins/charmap/plugin';
import 'tinymce/plugins/code/plugin';
import 'tinymce/plugins/codesample/plugin';
import 'tinymce/plugins/directionality/plugin';
import 'tinymce/plugins/emoticons/plugin';
import 'tinymce/plugins/fullscreen/plugin';
import 'tinymce/plugins/help/plugin';
import 'tinymce/plugins/image/plugin';
import 'tinymce/plugins/importcss/plugin';
import 'tinymce/plugins/insertdatetime/plugin';
import 'tinymce/plugins/link/plugin';
import 'tinymce/plugins/lists/plugin';
import 'tinymce/plugins/media/plugin';
import 'tinymce/plugins/nonbreaking/plugin';
import 'tinymce/plugins/pagebreak/plugin';
import 'tinymce/plugins/preview/plugin';
import 'tinymce/plugins/quickbars/plugin';
import 'tinymce/plugins/save/plugin';
import 'tinymce/plugins/searchreplace/plugin';
import 'tinymce/plugins/table/plugin';
import 'tinymce/plugins/visualblocks/plugin';
import 'tinymce/plugins/visualchars/plugin';
import 'tinymce/plugins/wordcount/plugin';




try {
  window.Tinymce = Tinymce;
} catch (e) {}

export { Tinymce };
