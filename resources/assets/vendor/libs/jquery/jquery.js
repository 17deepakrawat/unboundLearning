import jQuery from 'jquery/dist/jquery';
import validate from "jquery-validation";
import valid from "jquery-validation";
import Inputmask from "inputmask";

const $ = jQuery;
try {
  window.jQuery = window.$ = jQuery;
} catch (e) {}

export { jQuery, $, validate, valid, Inputmask };
