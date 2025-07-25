import {
  init_jquery_dataTables,
  jquery_dataTables_default
} from "./chunk-BLVVVJWX.js";
import {
  require_jquery
} from "./chunk-DNMGBOI2.js";
import {
  __toESM
} from "./chunk-GFT2G5UO.js";

// node_modules/datatables.net-buttons/js/dataTables.buttons.mjs
var import_jquery = __toESM(require_jquery(), 1);
init_jquery_dataTables();
var $ = import_jquery.default;
var _instCounter = 0;
var _buttonCounter = 0;
var _dtButtons = jquery_dataTables_default.ext.buttons;
var _entityDecoder = null;
function _fadeIn(el, duration, fn) {
  if ($.fn.animate) {
    el.stop().fadeIn(duration, fn);
  } else {
    el.css("display", "block");
    if (fn) {
      fn.call(el);
    }
  }
}
function _fadeOut(el, duration, fn) {
  if ($.fn.animate) {
    el.stop().fadeOut(duration, fn);
  } else {
    el.css("display", "none");
    if (fn) {
      fn.call(el);
    }
  }
}
var Buttons = function(dt, config) {
  if (!(this instanceof Buttons)) {
    return function(settings) {
      return new Buttons(settings, dt).container();
    };
  }
  if (typeof config === "undefined") {
    config = {};
  }
  if (config === true) {
    config = {};
  }
  if (Array.isArray(config)) {
    config = { buttons: config };
  }
  this.c = $.extend(true, {}, Buttons.defaults, config);
  if (config.buttons) {
    this.c.buttons = config.buttons;
  }
  this.s = {
    dt: new jquery_dataTables_default.Api(dt),
    buttons: [],
    listenKeys: "",
    namespace: "dtb" + _instCounter++
  };
  this.dom = {
    container: $("<" + this.c.dom.container.tag + "/>").addClass(this.c.dom.container.className)
  };
  this._constructor();
};
$.extend(Buttons.prototype, {
  /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
   * Public methods
   */
  /**
   * Get the action of a button
   * @param  {int|string} Button index
   * @return {function}
   */
  /**
  * Set the action of a button
  * @param  {node} node Button element
  * @param  {function} action Function to set
  * @return {Buttons} Self for chaining
  */
  action: function(node, action) {
    var button = this._nodeToButton(node);
    if (action === void 0) {
      return button.conf.action;
    }
    button.conf.action = action;
    return this;
  },
  /**
   * Add an active class to the button to make to look active or get current
   * active state.
   * @param  {node} node Button element
   * @param  {boolean} [flag] Enable / disable flag
   * @return {Buttons} Self for chaining or boolean for getter
   */
  active: function(node, flag) {
    var button = this._nodeToButton(node);
    var klass = this.c.dom.button.active;
    var jqNode = $(button.node);
    if (button.inCollection && this.c.dom.collection.button && this.c.dom.collection.button.active !== void 0) {
      klass = this.c.dom.collection.button.active;
    }
    if (flag === void 0) {
      return jqNode.hasClass(klass);
    }
    jqNode.toggleClass(klass, flag === void 0 ? true : flag);
    return this;
  },
  /**
   * Add a new button
   * @param {object} config Button configuration object, base string name or function
   * @param {int|string} [idx] Button index for where to insert the button
   * @param {boolean} [draw=true] Trigger a draw. Set a false when adding
   *   lots of buttons, until the last button.
   * @return {Buttons} Self for chaining
   */
  add: function(config, idx, draw) {
    var buttons = this.s.buttons;
    if (typeof idx === "string") {
      var split = idx.split("-");
      var base = this.s;
      for (var i = 0, ien = split.length - 1; i < ien; i++) {
        base = base.buttons[split[i] * 1];
      }
      buttons = base.buttons;
      idx = split[split.length - 1] * 1;
    }
    this._expandButton(
      buttons,
      config,
      config !== void 0 ? config.split : void 0,
      (config === void 0 || config.split === void 0 || config.split.length === 0) && base !== void 0,
      false,
      idx
    );
    if (draw === void 0 || draw === true) {
      this._draw();
    }
    return this;
  },
  /**
   * Clear buttons from a collection and then insert new buttons
   */
  collectionRebuild: function(node, newButtons) {
    var button = this._nodeToButton(node);
    if (newButtons !== void 0) {
      var i;
      for (i = button.buttons.length - 1; i >= 0; i--) {
        this.remove(button.buttons[i].node);
      }
      if (button.conf.prefixButtons) {
        newButtons.unshift.apply(newButtons, button.conf.prefixButtons);
      }
      if (button.conf.postfixButtons) {
        newButtons.push.apply(newButtons, button.conf.postfixButtons);
      }
      for (i = 0; i < newButtons.length; i++) {
        var newBtn = newButtons[i];
        this._expandButton(
          button.buttons,
          newBtn,
          newBtn !== void 0 && newBtn.config !== void 0 && newBtn.config.split !== void 0,
          true,
          newBtn.parentConf !== void 0 && newBtn.parentConf.split !== void 0,
          null,
          newBtn.parentConf
        );
      }
    }
    this._draw(button.collection, button.buttons);
  },
  /**
   * Get the container node for the buttons
   * @return {jQuery} Buttons node
   */
  container: function() {
    return this.dom.container;
  },
  /**
   * Disable a button
   * @param  {node} node Button node
   * @return {Buttons} Self for chaining
   */
  disable: function(node) {
    var button = this._nodeToButton(node);
    $(button.node).addClass(this.c.dom.button.disabled).prop("disabled", true);
    return this;
  },
  /**
   * Destroy the instance, cleaning up event handlers and removing DOM
   * elements
   * @return {Buttons} Self for chaining
   */
  destroy: function() {
    $("body").off("keyup." + this.s.namespace);
    var buttons = this.s.buttons.slice();
    var i, ien;
    for (i = 0, ien = buttons.length; i < ien; i++) {
      this.remove(buttons[i].node);
    }
    this.dom.container.remove();
    var buttonInsts = this.s.dt.settings()[0];
    for (i = 0, ien = buttonInsts.length; i < ien; i++) {
      if (buttonInsts.inst === this) {
        buttonInsts.splice(i, 1);
        break;
      }
    }
    return this;
  },
  /**
   * Enable / disable a button
   * @param  {node} node Button node
   * @param  {boolean} [flag=true] Enable / disable flag
   * @return {Buttons} Self for chaining
   */
  enable: function(node, flag) {
    if (flag === false) {
      return this.disable(node);
    }
    var button = this._nodeToButton(node);
    $(button.node).removeClass(this.c.dom.button.disabled).prop("disabled", false);
    return this;
  },
  /**
   * Get a button's index
   *
   * This is internally recursive
   * @param {element} node Button to get the index of
   * @return {string} Button index
   */
  index: function(node, nested, buttons) {
    if (!nested) {
      nested = "";
      buttons = this.s.buttons;
    }
    for (var i = 0, ien = buttons.length; i < ien; i++) {
      var inner = buttons[i].buttons;
      if (buttons[i].node === node) {
        return nested + i;
      }
      if (inner && inner.length) {
        var match = this.index(node, i + "-", inner);
        if (match !== null) {
          return match;
        }
      }
    }
    return null;
  },
  /**
   * Get the instance name for the button set selector
   * @return {string} Instance name
   */
  name: function() {
    return this.c.name;
  },
  /**
   * Get a button's node of the buttons container if no button is given
   * @param  {node} [node] Button node
   * @return {jQuery} Button element, or container
   */
  node: function(node) {
    if (!node) {
      return this.dom.container;
    }
    var button = this._nodeToButton(node);
    return $(button.node);
  },
  /**
   * Set / get a processing class on the selected button
   * @param {element} node Triggering button node
   * @param  {boolean} flag true to add, false to remove, undefined to get
   * @return {boolean|Buttons} Getter value or this if a setter.
   */
  processing: function(node, flag) {
    var dt = this.s.dt;
    var button = this._nodeToButton(node);
    if (flag === void 0) {
      return $(button.node).hasClass("processing");
    }
    $(button.node).toggleClass("processing", flag);
    $(dt.table().node()).triggerHandler("buttons-processing.dt", [
      flag,
      dt.button(node),
      dt,
      $(node),
      button.conf
    ]);
    return this;
  },
  /**
   * Remove a button.
   * @param  {node} node Button node
   * @return {Buttons} Self for chaining
   */
  remove: function(node) {
    var button = this._nodeToButton(node);
    var host = this._nodeToHost(node);
    var dt = this.s.dt;
    if (button.buttons.length) {
      for (var i = button.buttons.length - 1; i >= 0; i--) {
        this.remove(button.buttons[i].node);
      }
    }
    button.conf.destroying = true;
    if (button.conf.destroy) {
      button.conf.destroy.call(dt.button(node), dt, $(node), button.conf);
    }
    this._removeKey(button.conf);
    $(button.node).remove();
    var idx = $.inArray(button, host);
    host.splice(idx, 1);
    return this;
  },
  /**
   * Get the text for a button
   * @param  {int|string} node Button index
   * @return {string} Button text
   */
  /**
  * Set the text for a button
  * @param  {int|string|function} node Button index
  * @param  {string} label Text
  * @return {Buttons} Self for chaining
  */
  text: function(node, label) {
    var button = this._nodeToButton(node);
    var textNode = button.textNode;
    var dt = this.s.dt;
    var jqNode = $(button.node);
    var text = function(opt) {
      return typeof opt === "function" ? opt(dt, jqNode, button.conf) : opt;
    };
    if (label === void 0) {
      return text(button.conf.text);
    }
    button.conf.text = label;
    textNode.html(text(label));
    return this;
  },
  /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
   * Constructor
   */
  /**
   * Buttons constructor
   * @private
   */
  _constructor: function() {
    var that = this;
    var dt = this.s.dt;
    var dtSettings = dt.settings()[0];
    var buttons = this.c.buttons;
    if (!dtSettings._buttons) {
      dtSettings._buttons = [];
    }
    dtSettings._buttons.push({
      inst: this,
      name: this.c.name
    });
    for (var i = 0, ien = buttons.length; i < ien; i++) {
      this.add(buttons[i]);
    }
    dt.on("destroy", function(e, settings) {
      if (settings === dtSettings) {
        that.destroy();
      }
    });
    $("body").on("keyup." + this.s.namespace, function(e) {
      if (!document.activeElement || document.activeElement === document.body) {
        var character = String.fromCharCode(e.keyCode).toLowerCase();
        if (that.s.listenKeys.toLowerCase().indexOf(character) !== -1) {
          that._keypress(character, e);
        }
      }
    });
  },
  /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
   * Private methods
   */
  /**
   * Add a new button to the key press listener
   * @param {object} conf Resolved button configuration object
   * @private
   */
  _addKey: function(conf) {
    if (conf.key) {
      this.s.listenKeys += $.isPlainObject(conf.key) ? conf.key.key : conf.key;
    }
  },
  /**
   * Insert the buttons into the container. Call without parameters!
   * @param  {node} [container] Recursive only - Insert point
   * @param  {array} [buttons] Recursive only - Buttons array
   * @private
   */
  _draw: function(container, buttons) {
    if (!container) {
      container = this.dom.container;
      buttons = this.s.buttons;
    }
    container.children().detach();
    for (var i = 0, ien = buttons.length; i < ien; i++) {
      container.append(buttons[i].inserter);
      container.append(" ");
      if (buttons[i].buttons && buttons[i].buttons.length) {
        this._draw(buttons[i].collection, buttons[i].buttons);
      }
    }
  },
  /**
   * Create buttons from an array of buttons
   * @param  {array} attachTo Buttons array to attach to
   * @param  {object} button Button definition
   * @param  {boolean} inCollection true if the button is in a collection
   * @private
   */
  _expandButton: function(attachTo, button, split, inCollection, inSplit, attachPoint, parentConf) {
    var dt = this.s.dt;
    var isSplit = false;
    var domCollection = this.c.dom.collection;
    var buttons = !Array.isArray(button) ? [button] : button;
    if (button === void 0) {
      buttons = !Array.isArray(split) ? [split] : split;
    }
    for (var i = 0, ien = buttons.length; i < ien; i++) {
      var conf = this._resolveExtends(buttons[i]);
      if (!conf) {
        continue;
      }
      isSplit = conf.config && conf.config.split ? true : false;
      if (Array.isArray(conf)) {
        this._expandButton(
          attachTo,
          conf,
          built !== void 0 && built.conf !== void 0 ? built.conf.split : void 0,
          inCollection,
          parentConf !== void 0 && parentConf.split !== void 0,
          attachPoint,
          parentConf
        );
        continue;
      }
      var built = this._buildButton(
        conf,
        inCollection,
        conf.split !== void 0 || conf.config !== void 0 && conf.config.split !== void 0,
        inSplit
      );
      if (!built) {
        continue;
      }
      if (attachPoint !== void 0 && attachPoint !== null) {
        attachTo.splice(attachPoint, 0, built);
        attachPoint++;
      } else {
        attachTo.push(built);
      }
      if (built.conf.buttons) {
        built.collection = $("<" + domCollection.container.content.tag + "/>");
        built.conf._collection = built.collection;
        $(built.node).append(domCollection.action.dropHtml);
        this._expandButton(
          built.buttons,
          built.conf.buttons,
          built.conf.split,
          !isSplit,
          isSplit,
          attachPoint,
          built.conf
        );
      }
      if (built.conf.split) {
        built.collection = $("<" + domCollection.container.tag + "/>");
        built.conf._collection = built.collection;
        for (var j = 0; j < built.conf.split.length; j++) {
          var item = built.conf.split[j];
          if (typeof item === "object") {
            item.parent = parentConf;
            if (item.collectionLayout === void 0) {
              item.collectionLayout = built.conf.collectionLayout;
            }
            if (item.dropup === void 0) {
              item.dropup = built.conf.dropup;
            }
            if (item.fade === void 0) {
              item.fade = built.conf.fade;
            }
          }
        }
        this._expandButton(
          built.buttons,
          built.conf.buttons,
          built.conf.split,
          !isSplit,
          isSplit,
          attachPoint,
          built.conf
        );
      }
      built.conf.parent = parentConf;
      if (conf.init) {
        conf.init.call(dt.button(built.node), dt, $(built.node), conf);
      }
    }
  },
  /**
   * Create an individual button
   * @param  {object} config            Resolved button configuration
   * @param  {boolean} inCollection `true` if a collection button
   * @return {object} Completed button description object
   * @private
   */
  _buildButton: function(config, inCollection, isSplit, inSplit) {
    var configDom = this.c.dom;
    var textNode;
    var dt = this.s.dt;
    var text = function(opt) {
      return typeof opt === "function" ? opt(dt, button, config) : opt;
    };
    var dom = $.extend(true, {}, configDom.button);
    if (inCollection && isSplit && configDom.collection.split) {
      $.extend(true, dom, configDom.collection.split.action);
    } else if (inSplit || inCollection) {
      $.extend(true, dom, configDom.collection.button);
    } else if (isSplit) {
      $.extend(true, dom, configDom.split.button);
    }
    if (config.spacer) {
      var spacer = $("<" + dom.spacer.tag + "/>").addClass("dt-button-spacer " + config.style + " " + dom.spacer.className).html(text(config.text));
      return {
        conf: config,
        node: spacer,
        inserter: spacer,
        buttons: [],
        inCollection,
        isSplit,
        collection: null,
        textNode: spacer
      };
    }
    if (config.available && !config.available(dt, config) && !config.hasOwnProperty("html")) {
      return false;
    }
    var button;
    if (!config.hasOwnProperty("html")) {
      var action = function(e, dt2, button2, config2) {
        config2.action.call(dt2.button(button2), e, dt2, button2, config2);
        $(dt2.table().node()).triggerHandler("buttons-action.dt", [
          dt2.button(button2),
          dt2,
          button2,
          config2
        ]);
      };
      var tag = config.tag || dom.tag;
      var clickBlurs = config.clickBlurs === void 0 ? true : config.clickBlurs;
      button = $("<" + tag + "/>").addClass(dom.className).attr("tabindex", this.s.dt.settings()[0].iTabIndex).attr("aria-controls", this.s.dt.table().node().id).on("click.dtb", function(e) {
        e.preventDefault();
        if (!button.hasClass(dom.disabled) && config.action) {
          action(e, dt, button, config);
        }
        if (clickBlurs) {
          button.trigger("blur");
        }
      }).on("keypress.dtb", function(e) {
        if (e.keyCode === 13) {
          e.preventDefault();
          if (!button.hasClass(dom.disabled) && config.action) {
            action(e, dt, button, config);
          }
        }
      });
      if (tag.toLowerCase() === "a") {
        button.attr("href", "#");
      }
      if (tag.toLowerCase() === "button") {
        button.attr("type", "button");
      }
      if (dom.liner.tag) {
        var liner = $("<" + dom.liner.tag + "/>").html(text(config.text)).addClass(dom.liner.className);
        if (dom.liner.tag.toLowerCase() === "a") {
          liner.attr("href", "#");
        }
        button.append(liner);
        textNode = liner;
      } else {
        button.html(text(config.text));
        textNode = button;
      }
      if (config.enabled === false) {
        button.addClass(dom.disabled);
      }
      if (config.className) {
        button.addClass(config.className);
      }
      if (config.titleAttr) {
        button.attr("title", text(config.titleAttr));
      }
      if (config.attr) {
        button.attr(config.attr);
      }
      if (!config.namespace) {
        config.namespace = ".dt-button-" + _buttonCounter++;
      }
      if (config.config !== void 0 && config.config.split) {
        config.split = config.config.split;
      }
    } else {
      button = $(config.html);
    }
    var buttonContainer = this.c.dom.buttonContainer;
    var inserter;
    if (buttonContainer && buttonContainer.tag) {
      inserter = $("<" + buttonContainer.tag + "/>").addClass(buttonContainer.className).append(button);
    } else {
      inserter = button;
    }
    this._addKey(config);
    if (this.c.buttonCreated) {
      inserter = this.c.buttonCreated(config, inserter);
    }
    var splitDiv;
    if (isSplit) {
      var dropdownConf = inCollection ? $.extend(true, this.c.dom.split, this.c.dom.collection.split) : this.c.dom.split;
      var wrapperConf = dropdownConf.wrapper;
      splitDiv = $("<" + wrapperConf.tag + "/>").addClass(wrapperConf.className).append(button);
      var dropButtonConfig = $.extend(config, {
        align: dropdownConf.dropdown.align,
        attr: {
          "aria-haspopup": "dialog",
          "aria-expanded": false
        },
        className: dropdownConf.dropdown.className,
        closeButton: false,
        splitAlignClass: dropdownConf.dropdown.splitAlignClass,
        text: dropdownConf.dropdown.text
      });
      this._addKey(dropButtonConfig);
      var splitAction = function(e, dt2, button2, config2) {
        _dtButtons.split.action.call(dt2.button(splitDiv), e, dt2, button2, config2);
        $(dt2.table().node()).triggerHandler("buttons-action.dt", [
          dt2.button(button2),
          dt2,
          button2,
          config2
        ]);
        button2.attr("aria-expanded", true);
      };
      var dropButton = $(
        '<button class="' + dropdownConf.dropdown.className + ' dt-button"></button>'
      ).html(dropdownConf.dropdown.dropHtml).on("click.dtb", function(e) {
        e.preventDefault();
        e.stopPropagation();
        if (!dropButton.hasClass(dom.disabled)) {
          splitAction(e, dt, dropButton, dropButtonConfig);
        }
        if (clickBlurs) {
          dropButton.trigger("blur");
        }
      }).on("keypress.dtb", function(e) {
        if (e.keyCode === 13) {
          e.preventDefault();
          if (!dropButton.hasClass(dom.disabled)) {
            splitAction(e, dt, dropButton, dropButtonConfig);
          }
        }
      });
      if (config.split.length === 0) {
        dropButton.addClass("dtb-hide-drop");
      }
      splitDiv.append(dropButton).attr(dropButtonConfig.attr);
    }
    return {
      conf: config,
      node: isSplit ? splitDiv.get(0) : button.get(0),
      inserter: isSplit ? splitDiv : inserter,
      buttons: [],
      inCollection,
      isSplit,
      inSplit,
      collection: null,
      textNode
    };
  },
  /**
   * Get the button object from a node (recursive)
   * @param  {node} node Button node
   * @param  {array} [buttons] Button array, uses base if not defined
   * @return {object} Button object
   * @private
   */
  _nodeToButton: function(node, buttons) {
    if (!buttons) {
      buttons = this.s.buttons;
    }
    for (var i = 0, ien = buttons.length; i < ien; i++) {
      if (buttons[i].node === node) {
        return buttons[i];
      }
      if (buttons[i].buttons.length) {
        var ret = this._nodeToButton(node, buttons[i].buttons);
        if (ret) {
          return ret;
        }
      }
    }
  },
  /**
   * Get container array for a button from a button node (recursive)
   * @param  {node} node Button node
   * @param  {array} [buttons] Button array, uses base if not defined
   * @return {array} Button's host array
   * @private
   */
  _nodeToHost: function(node, buttons) {
    if (!buttons) {
      buttons = this.s.buttons;
    }
    for (var i = 0, ien = buttons.length; i < ien; i++) {
      if (buttons[i].node === node) {
        return buttons;
      }
      if (buttons[i].buttons.length) {
        var ret = this._nodeToHost(node, buttons[i].buttons);
        if (ret) {
          return ret;
        }
      }
    }
  },
  /**
   * Handle a key press - determine if any button's key configured matches
   * what was typed and trigger the action if so.
   * @param  {string} character The character pressed
   * @param  {object} e Key event that triggered this call
   * @private
   */
  _keypress: function(character, e) {
    if (e._buttonsHandled) {
      return;
    }
    var run = function(conf, node) {
      if (!conf.key) {
        return;
      }
      if (conf.key === character) {
        e._buttonsHandled = true;
        $(node).click();
      } else if ($.isPlainObject(conf.key)) {
        if (conf.key.key !== character) {
          return;
        }
        if (conf.key.shiftKey && !e.shiftKey) {
          return;
        }
        if (conf.key.altKey && !e.altKey) {
          return;
        }
        if (conf.key.ctrlKey && !e.ctrlKey) {
          return;
        }
        if (conf.key.metaKey && !e.metaKey) {
          return;
        }
        e._buttonsHandled = true;
        $(node).click();
      }
    };
    var recurse = function(a) {
      for (var i = 0, ien = a.length; i < ien; i++) {
        run(a[i].conf, a[i].node);
        if (a[i].buttons.length) {
          recurse(a[i].buttons);
        }
      }
    };
    recurse(this.s.buttons);
  },
  /**
   * Remove a key from the key listener for this instance (to be used when a
   * button is removed)
   * @param  {object} conf Button configuration
   * @private
   */
  _removeKey: function(conf) {
    if (conf.key) {
      var character = $.isPlainObject(conf.key) ? conf.key.key : conf.key;
      var a = this.s.listenKeys.split("");
      var idx = $.inArray(character, a);
      a.splice(idx, 1);
      this.s.listenKeys = a.join("");
    }
  },
  /**
   * Resolve a button configuration
   * @param  {string|function|object} conf Button config to resolve
   * @return {object} Button configuration
   * @private
   */
  _resolveExtends: function(conf) {
    var that = this;
    var dt = this.s.dt;
    var i, ien;
    var toConfObject = function(base) {
      var loop = 0;
      while (!$.isPlainObject(base) && !Array.isArray(base)) {
        if (base === void 0) {
          return;
        }
        if (typeof base === "function") {
          base = base.call(that, dt, conf);
          if (!base) {
            return false;
          }
        } else if (typeof base === "string") {
          if (!_dtButtons[base]) {
            return { html: base };
          }
          base = _dtButtons[base];
        }
        loop++;
        if (loop > 30) {
          throw "Buttons: Too many iterations";
        }
      }
      return Array.isArray(base) ? base : $.extend({}, base);
    };
    conf = toConfObject(conf);
    while (conf && conf.extend) {
      if (!_dtButtons[conf.extend]) {
        throw "Cannot extend unknown button type: " + conf.extend;
      }
      var objArray = toConfObject(_dtButtons[conf.extend]);
      if (Array.isArray(objArray)) {
        return objArray;
      } else if (!objArray) {
        return false;
      }
      var originalClassName = objArray.className;
      if (conf.config !== void 0 && objArray.config !== void 0) {
        conf.config = $.extend({}, objArray.config, conf.config);
      }
      conf = $.extend({}, objArray, conf);
      if (originalClassName && conf.className !== originalClassName) {
        conf.className = originalClassName + " " + conf.className;
      }
      conf.extend = objArray.extend;
    }
    var postfixButtons = conf.postfixButtons;
    if (postfixButtons) {
      if (!conf.buttons) {
        conf.buttons = [];
      }
      for (i = 0, ien = postfixButtons.length; i < ien; i++) {
        conf.buttons.push(postfixButtons[i]);
      }
    }
    var prefixButtons = conf.prefixButtons;
    if (prefixButtons) {
      if (!conf.buttons) {
        conf.buttons = [];
      }
      for (i = 0, ien = prefixButtons.length; i < ien; i++) {
        conf.buttons.splice(i, 0, prefixButtons[i]);
      }
    }
    return conf;
  },
  /**
   * Display (and replace if there is an existing one) a popover attached to a button
   * @param {string|node} content Content to show
   * @param {DataTable.Api} hostButton DT API instance of the button
   * @param {object} inOpts Options (see object below for all options)
   */
  _popover: function(content, hostButton, inOpts, e) {
    var dt = hostButton;
    var c = this.c;
    var closed = false;
    var options = $.extend(
      {
        align: "button-left",
        // button-right, dt-container, split-left, split-right
        autoClose: false,
        background: true,
        backgroundClassName: "dt-button-background",
        closeButton: true,
        containerClassName: c.dom.collection.container.className,
        contentClassName: c.dom.collection.container.content.className,
        collectionLayout: "",
        collectionTitle: "",
        dropup: false,
        fade: 400,
        popoverTitle: "",
        rightAlignClassName: "dt-button-right",
        tag: c.dom.collection.container.tag
      },
      inOpts
    );
    var containerSelector = options.tag + "." + options.containerClassName.replace(/ /g, ".");
    var hostNode = hostButton.node();
    var close = function() {
      closed = true;
      _fadeOut($(containerSelector), options.fade, function() {
        $(this).detach();
      });
      $(dt.buttons('[aria-haspopup="dialog"][aria-expanded="true"]').nodes()).attr(
        "aria-expanded",
        "false"
      );
      $("div.dt-button-background").off("click.dtb-collection");
      Buttons.background(false, options.backgroundClassName, options.fade, hostNode);
      $(window).off("resize.resize.dtb-collection");
      $("body").off(".dtb-collection");
      dt.off("buttons-action.b-internal");
      dt.off("destroy");
    };
    if (content === false) {
      close();
      return;
    }
    var existingExpanded = $(
      dt.buttons('[aria-haspopup="dialog"][aria-expanded="true"]').nodes()
    );
    if (existingExpanded.length) {
      if (hostNode.closest(containerSelector).length) {
        hostNode = existingExpanded.eq(0);
      }
      close();
    }
    var cnt = $(".dt-button", content).length;
    var mod = "";
    if (cnt === 3) {
      mod = "dtb-b3";
    } else if (cnt === 2) {
      mod = "dtb-b2";
    } else if (cnt === 1) {
      mod = "dtb-b1";
    }
    var display = $("<" + options.tag + "/>").addClass(options.containerClassName).addClass(options.collectionLayout).addClass(options.splitAlignClass).addClass(mod).css("display", "none").attr({
      "aria-modal": true,
      role: "dialog"
    });
    content = $(content).addClass(options.contentClassName).attr("role", "menu").appendTo(display);
    hostNode.attr("aria-expanded", "true");
    if (hostNode.parents("body")[0] !== document.body) {
      hostNode = document.body.lastChild;
    }
    if (options.popoverTitle) {
      display.prepend(
        '<div class="dt-button-collection-title">' + options.popoverTitle + "</div>"
      );
    } else if (options.collectionTitle) {
      display.prepend(
        '<div class="dt-button-collection-title">' + options.collectionTitle + "</div>"
      );
    }
    if (options.closeButton) {
      display.prepend('<div class="dtb-popover-close">&times;</div>').addClass("dtb-collection-closeable");
    }
    _fadeIn(display.insertAfter(hostNode), options.fade);
    var tableContainer = $(hostButton.table().container());
    var position = display.css("position");
    if (options.span === "container" || options.align === "dt-container") {
      hostNode = hostNode.parent();
      display.css("width", tableContainer.width());
    }
    if (position === "absolute") {
      var offsetParent = $(hostNode[0].offsetParent);
      var buttonPosition = hostNode.position();
      var buttonOffset = hostNode.offset();
      var tableSizes = offsetParent.offset();
      var containerPosition = offsetParent.position();
      var computed = window.getComputedStyle(offsetParent[0]);
      tableSizes.height = offsetParent.outerHeight();
      tableSizes.width = offsetParent.width() + parseFloat(computed.paddingLeft);
      tableSizes.right = tableSizes.left + tableSizes.width;
      tableSizes.bottom = tableSizes.top + tableSizes.height;
      var top = buttonPosition.top + hostNode.outerHeight();
      var left = buttonPosition.left;
      display.css({
        top,
        left
      });
      computed = window.getComputedStyle(display[0]);
      var popoverSizes = display.offset();
      popoverSizes.height = display.outerHeight();
      popoverSizes.width = display.outerWidth();
      popoverSizes.right = popoverSizes.left + popoverSizes.width;
      popoverSizes.bottom = popoverSizes.top + popoverSizes.height;
      popoverSizes.marginTop = parseFloat(computed.marginTop);
      popoverSizes.marginBottom = parseFloat(computed.marginBottom);
      if (options.dropup) {
        top = buttonPosition.top - popoverSizes.height - popoverSizes.marginTop - popoverSizes.marginBottom;
      }
      if (options.align === "button-right" || display.hasClass(options.rightAlignClassName)) {
        left = buttonPosition.left - popoverSizes.width + hostNode.outerWidth();
      }
      if (options.align === "dt-container" || options.align === "container") {
        if (left < buttonPosition.left) {
          left = -buttonPosition.left;
        }
        if (left + popoverSizes.width > tableSizes.width) {
          left = tableSizes.width - popoverSizes.width;
        }
      }
      if (containerPosition.left + left + popoverSizes.width > $(window).width()) {
        left = $(window).width() - popoverSizes.width - containerPosition.left;
      }
      if (buttonOffset.left + left < 0) {
        left = -buttonOffset.left;
      }
      if (containerPosition.top + top + popoverSizes.height > $(window).height() + $(window).scrollTop()) {
        top = buttonPosition.top - popoverSizes.height - popoverSizes.marginTop - popoverSizes.marginBottom;
      }
      if (containerPosition.top + top < $(window).scrollTop()) {
        top = buttonPosition.top + hostNode.outerHeight();
      }
      display.css({
        top,
        left
      });
    } else {
      var position = function() {
        var half = $(window).height() / 2;
        var top2 = display.height() / 2;
        if (top2 > half) {
          top2 = half;
        }
        display.css("marginTop", top2 * -1);
      };
      position();
      $(window).on("resize.dtb-collection", function() {
        position();
      });
    }
    if (options.background) {
      Buttons.background(
        true,
        options.backgroundClassName,
        options.fade,
        options.backgroundHost || hostNode
      );
    }
    $("div.dt-button-background").on("click.dtb-collection", function() {
    });
    if (options.autoClose) {
      setTimeout(function() {
        dt.on("buttons-action.b-internal", function(e2, btn, dt2, node) {
          if (node[0] === hostNode[0]) {
            return;
          }
          close();
        });
      }, 0);
    }
    $(display).trigger("buttons-popover.dt");
    dt.on("destroy", close);
    setTimeout(function() {
      closed = false;
      $("body").on("click.dtb-collection", function(e2) {
        if (closed) {
          return;
        }
        var back = $.fn.addBack ? "addBack" : "andSelf";
        var parent = $(e2.target).parent()[0];
        if (!$(e2.target).parents()[back]().filter(content).length && !$(parent).hasClass("dt-buttons") || $(e2.target).hasClass("dt-button-background")) {
          close();
        }
      }).on("keyup.dtb-collection", function(e2) {
        if (e2.keyCode === 27) {
          close();
        }
      }).on("keydown.dtb-collection", function(e2) {
        var elements = $("a, button", content);
        var active = document.activeElement;
        if (e2.keyCode !== 9) {
          return;
        }
        if (elements.index(active) === -1) {
          elements.first().focus();
          e2.preventDefault();
        } else if (e2.shiftKey) {
          if (active === elements[0]) {
            elements.last().focus();
            e2.preventDefault();
          }
        } else {
          if (active === elements.last()[0]) {
            elements.first().focus();
            e2.preventDefault();
          }
        }
      });
    }, 0);
  }
});
Buttons.background = function(show, className, fade, insertPoint) {
  if (fade === void 0) {
    fade = 400;
  }
  if (!insertPoint) {
    insertPoint = document.body;
  }
  if (show) {
    _fadeIn(
      $("<div/>").addClass(className).css("display", "none").insertAfter(insertPoint),
      fade
    );
  } else {
    _fadeOut($("div." + className), fade, function() {
      $(this).removeClass(className).remove();
    });
  }
};
Buttons.instanceSelector = function(group, buttons) {
  if (group === void 0 || group === null) {
    return $.map(buttons, function(v) {
      return v.inst;
    });
  }
  var ret = [];
  var names = $.map(buttons, function(v) {
    return v.name;
  });
  var process = function(input) {
    if (Array.isArray(input)) {
      for (var i = 0, ien = input.length; i < ien; i++) {
        process(input[i]);
      }
      return;
    }
    if (typeof input === "string") {
      if (input.indexOf(",") !== -1) {
        process(input.split(","));
      } else {
        var idx = $.inArray(input.trim(), names);
        if (idx !== -1) {
          ret.push(buttons[idx].inst);
        }
      }
    } else if (typeof input === "number") {
      ret.push(buttons[input].inst);
    } else if (typeof input === "object") {
      ret.push(input);
    }
  };
  process(group);
  return ret;
};
Buttons.buttonSelector = function(insts, selector) {
  var ret = [];
  var nodeBuilder = function(a, buttons, baseIdx) {
    var button;
    var idx;
    for (var i2 = 0, ien2 = buttons.length; i2 < ien2; i2++) {
      button = buttons[i2];
      if (button) {
        idx = baseIdx !== void 0 ? baseIdx + i2 : i2 + "";
        a.push({
          node: button.node,
          name: button.conf.name,
          idx
        });
        if (button.buttons) {
          nodeBuilder(a, button.buttons, idx + "-");
        }
      }
    }
  };
  var run = function(selector2, inst2) {
    var i2, ien2;
    var buttons = [];
    nodeBuilder(buttons, inst2.s.buttons);
    var nodes = $.map(buttons, function(v) {
      return v.node;
    });
    if (Array.isArray(selector2) || selector2 instanceof $) {
      for (i2 = 0, ien2 = selector2.length; i2 < ien2; i2++) {
        run(selector2[i2], inst2);
      }
      return;
    }
    if (selector2 === null || selector2 === void 0 || selector2 === "*") {
      for (i2 = 0, ien2 = buttons.length; i2 < ien2; i2++) {
        ret.push({
          inst: inst2,
          node: buttons[i2].node
        });
      }
    } else if (typeof selector2 === "number") {
      if (inst2.s.buttons[selector2]) {
        ret.push({
          inst: inst2,
          node: inst2.s.buttons[selector2].node
        });
      }
    } else if (typeof selector2 === "string") {
      if (selector2.indexOf(",") !== -1) {
        var a = selector2.split(",");
        for (i2 = 0, ien2 = a.length; i2 < ien2; i2++) {
          run(a[i2].trim(), inst2);
        }
      } else if (selector2.match(/^\d+(\-\d+)*$/)) {
        var indexes = $.map(buttons, function(v) {
          return v.idx;
        });
        ret.push({
          inst: inst2,
          node: buttons[$.inArray(selector2, indexes)].node
        });
      } else if (selector2.indexOf(":name") !== -1) {
        var name = selector2.replace(":name", "");
        for (i2 = 0, ien2 = buttons.length; i2 < ien2; i2++) {
          if (buttons[i2].name === name) {
            ret.push({
              inst: inst2,
              node: buttons[i2].node
            });
          }
        }
      } else {
        $(nodes).filter(selector2).each(function() {
          ret.push({
            inst: inst2,
            node: this
          });
        });
      }
    } else if (typeof selector2 === "object" && selector2.nodeName) {
      var idx = $.inArray(selector2, nodes);
      if (idx !== -1) {
        ret.push({
          inst: inst2,
          node: nodes[idx]
        });
      }
    }
  };
  for (var i = 0, ien = insts.length; i < ien; i++) {
    var inst = insts[i];
    run(selector, inst);
  }
  return ret;
};
Buttons.stripData = function(str, config) {
  if (typeof str !== "string") {
    return str;
  }
  str = str.replace(/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi, "");
  str = str.replace(/<!\-\-.*?\-\->/g, "");
  if (!config || config.stripHtml) {
    str = str.replace(/<[^>]*>/g, "");
  }
  if (!config || config.trim) {
    str = str.replace(/^\s+|\s+$/g, "");
  }
  if (!config || config.stripNewlines) {
    str = str.replace(/\n/g, " ");
  }
  if (!config || config.decodeEntities) {
    if (_entityDecoder) {
      str = _entityDecoder(str);
    } else {
      _exportTextarea.innerHTML = str;
      str = _exportTextarea.value;
    }
  }
  return str;
};
Buttons.entityDecoder = function(fn) {
  _entityDecoder = fn;
};
Buttons.defaults = {
  buttons: ["copy", "excel", "csv", "pdf", "print"],
  name: "main",
  tabIndex: 0,
  dom: {
    container: {
      tag: "div",
      className: "dt-buttons"
    },
    collection: {
      action: {
        // action button
        dropHtml: '<span class="dt-button-down-arrow">&#x25BC;</span>'
      },
      container: {
        // The element used for the dropdown
        className: "dt-button-collection",
        content: {
          className: "",
          tag: "div"
        },
        tag: "div"
      }
      // optionally
      // , button: IButton - buttons inside the collection container
      // , split: ISplit - splits inside the collection container
    },
    button: {
      tag: "button",
      className: "dt-button",
      active: "dt-button-active",
      // class name
      disabled: "disabled",
      // class name
      spacer: {
        className: "dt-button-spacer",
        tag: "span"
      },
      liner: {
        tag: "span",
        className: ""
      }
    },
    split: {
      action: {
        // action button
        className: "dt-button-split-drop-button dt-button",
        tag: "button"
      },
      dropdown: {
        // button to trigger the dropdown
        align: "split-right",
        className: "dt-button-split-drop",
        dropHtml: '<span class="dt-button-down-arrow">&#x25BC;</span>',
        splitAlignClass: "dt-button-split-left",
        tag: "button"
      },
      wrapper: {
        // wrap around both
        className: "dt-button-split",
        tag: "div"
      }
    }
  }
};
Buttons.version = "2.4.2";
$.extend(_dtButtons, {
  collection: {
    text: function(dt) {
      return dt.i18n("buttons.collection", "Collection");
    },
    className: "buttons-collection",
    closeButton: false,
    init: function(dt, button, config) {
      button.attr("aria-expanded", false);
    },
    action: function(e, dt, button, config) {
      if (config._collection.parents("body").length) {
        this.popover(false, config);
      } else {
        this.popover(config._collection, config);
      }
      if (e.type === "keypress") {
        $("a, button", config._collection).eq(0).focus();
      }
    },
    attr: {
      "aria-haspopup": "dialog"
    }
    // Also the popover options, defined in Buttons.popover
  },
  split: {
    text: function(dt) {
      return dt.i18n("buttons.split", "Split");
    },
    className: "buttons-split",
    closeButton: false,
    init: function(dt, button, config) {
      return button.attr("aria-expanded", false);
    },
    action: function(e, dt, button, config) {
      this.popover(config._collection, config);
    },
    attr: {
      "aria-haspopup": "dialog"
    }
    // Also the popover options, defined in Buttons.popover
  },
  copy: function(dt, conf) {
    if (_dtButtons.copyHtml5) {
      return "copyHtml5";
    }
  },
  csv: function(dt, conf) {
    if (_dtButtons.csvHtml5 && _dtButtons.csvHtml5.available(dt, conf)) {
      return "csvHtml5";
    }
  },
  excel: function(dt, conf) {
    if (_dtButtons.excelHtml5 && _dtButtons.excelHtml5.available(dt, conf)) {
      return "excelHtml5";
    }
  },
  pdf: function(dt, conf) {
    if (_dtButtons.pdfHtml5 && _dtButtons.pdfHtml5.available(dt, conf)) {
      return "pdfHtml5";
    }
  },
  pageLength: function(dt) {
    var lengthMenu = dt.settings()[0].aLengthMenu;
    var vals = [];
    var lang = [];
    var text = function(dt2) {
      return dt2.i18n(
        "buttons.pageLength",
        {
          "-1": "Show all rows",
          _: "Show %d rows"
        },
        dt2.page.len()
      );
    };
    if (Array.isArray(lengthMenu[0])) {
      vals = lengthMenu[0];
      lang = lengthMenu[1];
    } else {
      for (var i = 0; i < lengthMenu.length; i++) {
        var option = lengthMenu[i];
        if ($.isPlainObject(option)) {
          vals.push(option.value);
          lang.push(option.label);
        } else {
          vals.push(option);
          lang.push(option);
        }
      }
    }
    return {
      extend: "collection",
      text,
      className: "buttons-page-length",
      autoClose: true,
      buttons: $.map(vals, function(val, i2) {
        return {
          text: lang[i2],
          className: "button-page-length",
          action: function(e, dt2) {
            dt2.page.len(val).draw();
          },
          init: function(dt2, node, conf) {
            var that = this;
            var fn = function() {
              that.active(dt2.page.len() === val);
            };
            dt2.on("length.dt" + conf.namespace, fn);
            fn();
          },
          destroy: function(dt2, node, conf) {
            dt2.off("length.dt" + conf.namespace);
          }
        };
      }),
      init: function(dt2, node, conf) {
        var that = this;
        dt2.on("length.dt" + conf.namespace, function() {
          that.text(conf.text);
        });
      },
      destroy: function(dt2, node, conf) {
        dt2.off("length.dt" + conf.namespace);
      }
    };
  },
  spacer: {
    style: "empty",
    spacer: true,
    text: function(dt) {
      return dt.i18n("buttons.spacer", "");
    }
  }
});
jquery_dataTables_default.Api.register("buttons()", function(group, selector) {
  if (selector === void 0) {
    selector = group;
    group = void 0;
  }
  this.selector.buttonGroup = group;
  var res = this.iterator(
    true,
    "table",
    function(ctx) {
      if (ctx._buttons) {
        return Buttons.buttonSelector(
          Buttons.instanceSelector(group, ctx._buttons),
          selector
        );
      }
    },
    true
  );
  res._groupSelector = group;
  return res;
});
jquery_dataTables_default.Api.register("button()", function(group, selector) {
  var buttons = this.buttons(group, selector);
  if (buttons.length > 1) {
    buttons.splice(1, buttons.length);
  }
  return buttons;
});
jquery_dataTables_default.Api.registerPlural("buttons().active()", "button().active()", function(flag) {
  if (flag === void 0) {
    return this.map(function(set) {
      return set.inst.active(set.node);
    });
  }
  return this.each(function(set) {
    set.inst.active(set.node, flag);
  });
});
jquery_dataTables_default.Api.registerPlural("buttons().action()", "button().action()", function(action) {
  if (action === void 0) {
    return this.map(function(set) {
      return set.inst.action(set.node);
    });
  }
  return this.each(function(set) {
    set.inst.action(set.node, action);
  });
});
jquery_dataTables_default.Api.registerPlural(
  "buttons().collectionRebuild()",
  "button().collectionRebuild()",
  function(buttons) {
    return this.each(function(set) {
      for (var i = 0; i < buttons.length; i++) {
        if (typeof buttons[i] === "object") {
          buttons[i].parentConf = set;
        }
      }
      set.inst.collectionRebuild(set.node, buttons);
    });
  }
);
jquery_dataTables_default.Api.register(["buttons().enable()", "button().enable()"], function(flag) {
  return this.each(function(set) {
    set.inst.enable(set.node, flag);
  });
});
jquery_dataTables_default.Api.register(["buttons().disable()", "button().disable()"], function() {
  return this.each(function(set) {
    set.inst.disable(set.node);
  });
});
jquery_dataTables_default.Api.register("button().index()", function() {
  var idx = null;
  this.each(function(set) {
    var res = set.inst.index(set.node);
    if (res !== null) {
      idx = res;
    }
  });
  return idx;
});
jquery_dataTables_default.Api.registerPlural("buttons().nodes()", "button().node()", function() {
  var jq = $();
  $(
    this.each(function(set) {
      jq = jq.add(set.inst.node(set.node));
    })
  );
  return jq;
});
jquery_dataTables_default.Api.registerPlural("buttons().processing()", "button().processing()", function(flag) {
  if (flag === void 0) {
    return this.map(function(set) {
      return set.inst.processing(set.node);
    });
  }
  return this.each(function(set) {
    set.inst.processing(set.node, flag);
  });
});
jquery_dataTables_default.Api.registerPlural("buttons().text()", "button().text()", function(label) {
  if (label === void 0) {
    return this.map(function(set) {
      return set.inst.text(set.node);
    });
  }
  return this.each(function(set) {
    set.inst.text(set.node, label);
  });
});
jquery_dataTables_default.Api.registerPlural("buttons().trigger()", "button().trigger()", function() {
  return this.each(function(set) {
    set.inst.node(set.node).trigger("click");
  });
});
jquery_dataTables_default.Api.register("button().popover()", function(content, options) {
  return this.map(function(set) {
    return set.inst._popover(content, this.button(this[0].node), options);
  });
});
jquery_dataTables_default.Api.register("buttons().containers()", function() {
  var jq = $();
  var groupSelector = this._groupSelector;
  this.iterator(true, "table", function(ctx) {
    if (ctx._buttons) {
      var insts = Buttons.instanceSelector(groupSelector, ctx._buttons);
      for (var i = 0, ien = insts.length; i < ien; i++) {
        jq = jq.add(insts[i].container());
      }
    }
  });
  return jq;
});
jquery_dataTables_default.Api.register("buttons().container()", function() {
  return this.containers().eq(0);
});
jquery_dataTables_default.Api.register("button().add()", function(idx, conf, draw) {
  var ctx = this.context;
  if (ctx.length) {
    var inst = Buttons.instanceSelector(this._groupSelector, ctx[0]._buttons);
    if (inst.length) {
      inst[0].add(conf, idx, draw);
    }
  }
  return this.button(this._groupSelector, idx);
});
jquery_dataTables_default.Api.register("buttons().destroy()", function() {
  this.pluck("inst").unique().each(function(inst) {
    inst.destroy();
  });
  return this;
});
jquery_dataTables_default.Api.registerPlural("buttons().remove()", "buttons().remove()", function() {
  this.each(function(set) {
    set.inst.remove(set.node);
  });
  return this;
});
var _infoTimer;
jquery_dataTables_default.Api.register("buttons.info()", function(title, message, time) {
  var that = this;
  if (title === false) {
    this.off("destroy.btn-info");
    _fadeOut($("#datatables_buttons_info"), 400, function() {
      $(this).remove();
    });
    clearTimeout(_infoTimer);
    _infoTimer = null;
    return this;
  }
  if (_infoTimer) {
    clearTimeout(_infoTimer);
  }
  if ($("#datatables_buttons_info").length) {
    $("#datatables_buttons_info").remove();
  }
  title = title ? "<h2>" + title + "</h2>" : "";
  _fadeIn(
    $('<div id="datatables_buttons_info" class="dt-button-info"/>').html(title).append($("<div/>")[typeof message === "string" ? "html" : "append"](message)).css("display", "none").appendTo("body")
  );
  if (time !== void 0 && time !== 0) {
    _infoTimer = setTimeout(function() {
      that.buttons.info(false);
    }, time);
  }
  this.on("destroy.btn-info", function() {
    that.buttons.info(false);
  });
  return this;
});
jquery_dataTables_default.Api.register("buttons.exportData()", function(options) {
  if (this.context.length) {
    return _exportData(new jquery_dataTables_default.Api(this.context[0]), options);
  }
});
jquery_dataTables_default.Api.register("buttons.exportInfo()", function(conf) {
  if (!conf) {
    conf = {};
  }
  return {
    filename: _filename(conf),
    title: _title(conf),
    messageTop: _message(this, conf.message || conf.messageTop, "top"),
    messageBottom: _message(this, conf.messageBottom, "bottom")
  };
});
var _filename = function(config) {
  var filename = config.filename === "*" && config.title !== "*" && config.title !== void 0 && config.title !== null && config.title !== "" ? config.title : config.filename;
  if (typeof filename === "function") {
    filename = filename();
  }
  if (filename === void 0 || filename === null) {
    return null;
  }
  if (filename.indexOf("*") !== -1) {
    filename = filename.replace("*", $("head > title").text()).trim();
  }
  filename = filename.replace(/[^a-zA-Z0-9_\u00A1-\uFFFF\.,\-_ !\(\)]/g, "");
  var extension = _stringOrFunction(config.extension);
  if (!extension) {
    extension = "";
  }
  return filename + extension;
};
var _stringOrFunction = function(option) {
  if (option === null || option === void 0) {
    return null;
  } else if (typeof option === "function") {
    return option();
  }
  return option;
};
var _title = function(config) {
  var title = _stringOrFunction(config.title);
  return title === null ? null : title.indexOf("*") !== -1 ? title.replace("*", $("head > title").text() || "Exported data") : title;
};
var _message = function(dt, option, position) {
  var message = _stringOrFunction(option);
  if (message === null) {
    return null;
  }
  var caption = $("caption", dt.table().container()).eq(0);
  if (message === "*") {
    var side = caption.css("caption-side");
    if (side !== position) {
      return null;
    }
    return caption.length ? caption.text() : "";
  }
  return message;
};
var _exportTextarea = $("<textarea/>")[0];
var _exportData = function(dt, inOpts) {
  var config = $.extend(
    true,
    {},
    {
      rows: null,
      columns: "",
      modifier: {
        search: "applied",
        order: "applied"
      },
      orthogonal: "display",
      stripHtml: true,
      stripNewlines: true,
      decodeEntities: true,
      trim: true,
      format: {
        header: function(d) {
          return Buttons.stripData(d, config);
        },
        footer: function(d) {
          return Buttons.stripData(d, config);
        },
        body: function(d) {
          return Buttons.stripData(d, config);
        }
      },
      customizeData: null
    },
    inOpts
  );
  var header = dt.columns(config.columns).indexes().map(function(idx) {
    var el = dt.column(idx).header();
    return config.format.header(el.innerHTML, idx, el);
  }).toArray();
  var footer = dt.table().footer() ? dt.columns(config.columns).indexes().map(function(idx) {
    var el = dt.column(idx).footer();
    return config.format.footer(el ? el.innerHTML : "", idx, el);
  }).toArray() : null;
  var modifier = $.extend({}, config.modifier);
  if (dt.select && typeof dt.select.info === "function" && modifier.selected === void 0) {
    if (dt.rows(config.rows, $.extend({ selected: true }, modifier)).any()) {
      $.extend(modifier, { selected: true });
    }
  }
  var rowIndexes = dt.rows(config.rows, modifier).indexes().toArray();
  var selectedCells = dt.cells(rowIndexes, config.columns);
  var cells = selectedCells.render(config.orthogonal).toArray();
  var cellNodes = selectedCells.nodes().toArray();
  var columns = header.length;
  var rows = columns > 0 ? cells.length / columns : 0;
  var body = [];
  var cellCounter = 0;
  for (var i = 0, ien = rows; i < ien; i++) {
    var row = [columns];
    for (var j = 0; j < columns; j++) {
      row[j] = config.format.body(cells[cellCounter], i, j, cellNodes[cellCounter]);
      cellCounter++;
    }
    body[i] = row;
  }
  var data = {
    header,
    footer,
    body
  };
  if (config.customizeData) {
    config.customizeData(data);
  }
  return data;
};
$.fn.dataTable.Buttons = Buttons;
$.fn.DataTable.Buttons = Buttons;
$(document).on("init.dt plugin-init.dt", function(e, settings) {
  if (e.namespace !== "dt") {
    return;
  }
  var opts = settings.oInit.buttons || jquery_dataTables_default.defaults.buttons;
  if (opts && !settings._buttons) {
    new Buttons(settings, opts).container();
  }
});
function _init(settings, options) {
  var api = new jquery_dataTables_default.Api(settings);
  var opts = options ? options : api.init().buttons || jquery_dataTables_default.defaults.buttons;
  return new Buttons(api, opts).container();
}
jquery_dataTables_default.ext.feature.push({
  fnInit: _init,
  cFeature: "B"
});
if (jquery_dataTables_default.ext.features) {
  jquery_dataTables_default.ext.features.register("buttons", _init);
}
var dataTables_buttons_default = jquery_dataTables_default;

export {
  dataTables_buttons_default
};
/*! Bundled license information:

datatables.net-buttons/js/dataTables.buttons.mjs:
  (*! Buttons for DataTables 2.4.2
   * © SpryMedia Ltd - datatables.net/license
   *)
*/
//# sourceMappingURL=chunk-72AF6TIL.js.map
