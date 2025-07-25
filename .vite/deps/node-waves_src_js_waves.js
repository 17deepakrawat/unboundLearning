import {
  __commonJS
} from "./chunk-GFT2G5UO.js";

// node_modules/node-waves/src/js/waves.js
var require_waves = __commonJS({
  "node_modules/node-waves/src/js/waves.js"(exports, module) {
    (function(window2, factory) {
      "use strict";
      if (typeof define === "function" && define.amd) {
        define([], function() {
          window2.Waves = factory.call(window2);
          return window2.Waves;
        });
      } else if (typeof exports === "object") {
        module.exports = factory.call(window2);
      } else {
        window2.Waves = factory.call(window2);
      }
    })(typeof global === "object" ? global : exports, function() {
      "use strict";
      var Waves = Waves || {};
      var $$ = document.querySelectorAll.bind(document);
      var toString = Object.prototype.toString;
      var isTouchAvailable = "ontouchstart" in window;
      function isWindow(obj) {
        return obj !== null && obj === obj.window;
      }
      function getWindow(elem) {
        return isWindow(elem) ? elem : elem.nodeType === 9 && elem.defaultView;
      }
      function isObject(value) {
        var type = typeof value;
        return type === "function" || type === "object" && !!value;
      }
      function isDOMNode(obj) {
        return isObject(obj) && obj.nodeType > 0;
      }
      function getWavesElements(nodes) {
        var stringRepr = toString.call(nodes);
        if (stringRepr === "[object String]") {
          return $$(nodes);
        } else if (isObject(nodes) && /^\[object (Array|HTMLCollection|NodeList|Object)\]$/.test(stringRepr) && nodes.hasOwnProperty("length")) {
          return nodes;
        } else if (isDOMNode(nodes)) {
          return [nodes];
        }
        return [];
      }
      function offset(elem) {
        var docElem, win, box = { top: 0, left: 0 }, doc = elem && elem.ownerDocument;
        docElem = doc.documentElement;
        if (typeof elem.getBoundingClientRect !== "undefined") {
          box = elem.getBoundingClientRect();
        }
        win = getWindow(doc);
        return {
          top: box.top + win.pageYOffset - docElem.clientTop,
          left: box.left + win.pageXOffset - docElem.clientLeft
        };
      }
      function convertStyle(styleObj) {
        var style = "";
        for (var prop in styleObj) {
          if (styleObj.hasOwnProperty(prop)) {
            style += prop + ":" + styleObj[prop] + ";";
          }
        }
        return style;
      }
      var Effect = {
        // Effect duration
        duration: 750,
        // Effect delay (check for scroll before showing effect)
        delay: 200,
        show: function(e, element, velocity) {
          if (e.button === 2) {
            return false;
          }
          element = element || this;
          var ripple = document.createElement("div");
          ripple.className = "waves-ripple waves-rippling";
          element.appendChild(ripple);
          var pos = offset(element);
          var relativeY = 0;
          var relativeX = 0;
          if ("touches" in e && e.touches.length) {
            relativeY = e.touches[0].pageY - pos.top;
            relativeX = e.touches[0].pageX - pos.left;
          } else {
            relativeY = e.pageY - pos.top;
            relativeX = e.pageX - pos.left;
          }
          relativeX = relativeX >= 0 ? relativeX : 0;
          relativeY = relativeY >= 0 ? relativeY : 0;
          var scale = "scale(" + element.clientWidth / 100 * 3 + ")";
          var translate = "translate(0,0)";
          if (velocity) {
            translate = "translate(" + velocity.x + "px, " + velocity.y + "px)";
          }
          ripple.setAttribute("data-hold", Date.now());
          ripple.setAttribute("data-x", relativeX);
          ripple.setAttribute("data-y", relativeY);
          ripple.setAttribute("data-scale", scale);
          ripple.setAttribute("data-translate", translate);
          var rippleStyle = {
            top: relativeY + "px",
            left: relativeX + "px"
          };
          ripple.classList.add("waves-notransition");
          ripple.setAttribute("style", convertStyle(rippleStyle));
          ripple.classList.remove("waves-notransition");
          rippleStyle["-webkit-transform"] = scale + " " + translate;
          rippleStyle["-moz-transform"] = scale + " " + translate;
          rippleStyle["-ms-transform"] = scale + " " + translate;
          rippleStyle["-o-transform"] = scale + " " + translate;
          rippleStyle.transform = scale + " " + translate;
          rippleStyle.opacity = "1";
          var duration = e.type === "mousemove" ? 2500 : Effect.duration;
          rippleStyle["-webkit-transition-duration"] = duration + "ms";
          rippleStyle["-moz-transition-duration"] = duration + "ms";
          rippleStyle["-o-transition-duration"] = duration + "ms";
          rippleStyle["transition-duration"] = duration + "ms";
          ripple.setAttribute("style", convertStyle(rippleStyle));
        },
        hide: function(e, element) {
          element = element || this;
          var ripples = element.getElementsByClassName("waves-rippling");
          for (var i = 0, len = ripples.length; i < len; i++) {
            removeRipple(e, element, ripples[i]);
          }
          if (isTouchAvailable) {
            element.removeEventListener("touchend", Effect.hide);
            element.removeEventListener("touchcancel", Effect.hide);
          }
          element.removeEventListener("mouseup", Effect.hide);
          element.removeEventListener("mouseleave", Effect.hide);
        }
      };
      var TagWrapper = {
        // Wrap <input> tag so it can perform the effect
        input: function(element) {
          var parent = element.parentNode;
          if (parent.tagName.toLowerCase() === "i" && parent.classList.contains("waves-effect")) {
            return;
          }
          var wrapper = document.createElement("i");
          wrapper.className = element.className + " waves-input-wrapper";
          element.className = "waves-button-input";
          parent.replaceChild(wrapper, element);
          wrapper.appendChild(element);
          var elementStyle = window.getComputedStyle(element, null);
          var color = elementStyle.color;
          var backgroundColor = elementStyle.backgroundColor;
          wrapper.setAttribute("style", "color:" + color + ";background:" + backgroundColor);
          element.setAttribute("style", "background-color:rgba(0,0,0,0);");
        },
        // Wrap <img> tag so it can perform the effect
        img: function(element) {
          var parent = element.parentNode;
          if (parent.tagName.toLowerCase() === "i" && parent.classList.contains("waves-effect")) {
            return;
          }
          var wrapper = document.createElement("i");
          parent.replaceChild(wrapper, element);
          wrapper.appendChild(element);
        }
      };
      function removeRipple(e, el, ripple) {
        if (!ripple) {
          return;
        }
        ripple.classList.remove("waves-rippling");
        var relativeX = ripple.getAttribute("data-x");
        var relativeY = ripple.getAttribute("data-y");
        var scale = ripple.getAttribute("data-scale");
        var translate = ripple.getAttribute("data-translate");
        var diff = Date.now() - Number(ripple.getAttribute("data-hold"));
        var delay = 350 - diff;
        if (delay < 0) {
          delay = 0;
        }
        if (e.type === "mousemove") {
          delay = 150;
        }
        var duration = e.type === "mousemove" ? 2500 : Effect.duration;
        setTimeout(function() {
          var style = {
            top: relativeY + "px",
            left: relativeX + "px",
            opacity: "0",
            // Duration
            "-webkit-transition-duration": duration + "ms",
            "-moz-transition-duration": duration + "ms",
            "-o-transition-duration": duration + "ms",
            "transition-duration": duration + "ms",
            "-webkit-transform": scale + " " + translate,
            "-moz-transform": scale + " " + translate,
            "-ms-transform": scale + " " + translate,
            "-o-transform": scale + " " + translate,
            "transform": scale + " " + translate
          };
          ripple.setAttribute("style", convertStyle(style));
          setTimeout(function() {
            try {
              el.removeChild(ripple);
            } catch (e2) {
              return false;
            }
          }, duration);
        }, delay);
      }
      var TouchHandler = {
        /* uses an integer rather than bool so there's no issues with
         * needing to clear timeouts if another touch event occurred
         * within the 500ms. Cannot mouseup between touchstart and
         * touchend, nor in the 500ms after touchend. */
        touches: 0,
        allowEvent: function(e) {
          var allow = true;
          if (/^(mousedown|mousemove)$/.test(e.type) && TouchHandler.touches) {
            allow = false;
          }
          return allow;
        },
        registerEvent: function(e) {
          var eType = e.type;
          if (eType === "touchstart") {
            TouchHandler.touches += 1;
          } else if (/^(touchend|touchcancel)$/.test(eType)) {
            setTimeout(function() {
              if (TouchHandler.touches) {
                TouchHandler.touches -= 1;
              }
            }, 500);
          }
        }
      };
      function getWavesEffectElement(e) {
        if (TouchHandler.allowEvent(e) === false) {
          return null;
        }
        var element = null;
        var target = e.target || e.srcElement;
        while (target.parentElement) {
          if (!(target instanceof SVGElement) && target.classList.contains("waves-effect")) {
            element = target;
            break;
          }
          target = target.parentElement;
        }
        return element;
      }
      function showEffect(e) {
        var element = getWavesEffectElement(e);
        if (element !== null) {
          if (element.disabled || element.getAttribute("disabled") || element.classList.contains("disabled")) {
            return;
          }
          TouchHandler.registerEvent(e);
          if (e.type === "touchstart" && Effect.delay) {
            var hidden = false;
            var timer = setTimeout(function() {
              timer = null;
              Effect.show(e, element);
            }, Effect.delay);
            var hideEffect = function(hideEvent) {
              if (timer) {
                clearTimeout(timer);
                timer = null;
                Effect.show(e, element);
              }
              if (!hidden) {
                hidden = true;
                Effect.hide(hideEvent, element);
              }
              removeListeners();
            };
            var touchMove = function(moveEvent) {
              if (timer) {
                clearTimeout(timer);
                timer = null;
              }
              hideEffect(moveEvent);
              removeListeners();
            };
            element.addEventListener("touchmove", touchMove, false);
            element.addEventListener("touchend", hideEffect, false);
            element.addEventListener("touchcancel", hideEffect, false);
            var removeListeners = function() {
              element.removeEventListener("touchmove", touchMove);
              element.removeEventListener("touchend", hideEffect);
              element.removeEventListener("touchcancel", hideEffect);
            };
          } else {
            Effect.show(e, element);
            if (isTouchAvailable) {
              element.addEventListener("touchend", Effect.hide, false);
              element.addEventListener("touchcancel", Effect.hide, false);
            }
            element.addEventListener("mouseup", Effect.hide, false);
            element.addEventListener("mouseleave", Effect.hide, false);
          }
        }
      }
      Waves.init = function(options) {
        var body = document.body;
        options = options || {};
        if ("duration" in options) {
          Effect.duration = options.duration;
        }
        if ("delay" in options) {
          Effect.delay = options.delay;
        }
        if (isTouchAvailable) {
          body.addEventListener("touchstart", showEffect, false);
          body.addEventListener("touchcancel", TouchHandler.registerEvent, false);
          body.addEventListener("touchend", TouchHandler.registerEvent, false);
        }
        body.addEventListener("mousedown", showEffect, false);
      };
      Waves.attach = function(elements, classes) {
        elements = getWavesElements(elements);
        if (toString.call(classes) === "[object Array]") {
          classes = classes.join(" ");
        }
        classes = classes ? " " + classes : "";
        var element, tagName;
        for (var i = 0, len = elements.length; i < len; i++) {
          element = elements[i];
          tagName = element.tagName.toLowerCase();
          if (["input", "img"].indexOf(tagName) !== -1) {
            TagWrapper[tagName](element);
            element = element.parentElement;
          }
          if (element.className.indexOf("waves-effect") === -1) {
            element.className += " waves-effect" + classes;
          }
        }
      };
      Waves.ripple = function(elements, options) {
        elements = getWavesElements(elements);
        var elementsLen = elements.length;
        options = options || {};
        options.wait = options.wait || 0;
        options.position = options.position || null;
        if (elementsLen) {
          var element, pos, off, centre = {}, i = 0;
          var mousedown = {
            type: "mousedown",
            button: 1
          };
          var hideRipple = function(mouseup2, element2) {
            return function() {
              Effect.hide(mouseup2, element2);
            };
          };
          for (; i < elementsLen; i++) {
            element = elements[i];
            pos = options.position || {
              x: element.clientWidth / 2,
              y: element.clientHeight / 2
            };
            off = offset(element);
            centre.x = off.left + pos.x;
            centre.y = off.top + pos.y;
            mousedown.pageX = centre.x;
            mousedown.pageY = centre.y;
            Effect.show(mousedown, element);
            if (options.wait >= 0 && options.wait !== null) {
              var mouseup = {
                type: "mouseup",
                button: 1
              };
              setTimeout(hideRipple(mouseup, element), options.wait);
            }
          }
        }
      };
      Waves.calm = function(elements) {
        elements = getWavesElements(elements);
        var mouseup = {
          type: "mouseup",
          button: 1
        };
        for (var i = 0, len = elements.length; i < len; i++) {
          Effect.hide(mouseup, elements[i]);
        }
      };
      Waves.displayEffect = function(options) {
        console.error("Waves.displayEffect() has been deprecated and will be removed in future version. Please use Waves.init() to initialize Waves effect");
        Waves.init(options);
      };
      return Waves;
    });
  }
});
export default require_waves();
/*! Bundled license information:

node-waves/src/js/waves.js:
  (*!
   * Waves v0.7.6
   * http://fian.my.id/Waves
   *
   * Copyright 2014-2018 Alfiana E. Sibuea and other contributors
   * Released under the MIT license
   * https://github.com/fians/Waves/blob/master/LICENSE
   *)
*/
//# sourceMappingURL=node-waves_src_js_waves.js.map
