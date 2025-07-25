import {
  __commonJS
} from "./chunk-GFT2G5UO.js";

// node_modules/@form-validation/core/lib/cjs/index.js
var require_cjs = __commonJS({
  "node_modules/@form-validation/core/lib/cjs/index.js"(exports) {
    "use strict";
    function luhn(value) {
      var length = value.length;
      var prodArr = [
        [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
        [0, 2, 4, 6, 8, 1, 3, 5, 7, 9]
      ];
      var mul = 0;
      var sum = 0;
      while (length--) {
        sum += prodArr[mul][parseInt(value.charAt(length), 10)];
        mul = 1 - mul;
      }
      return sum % 10 === 0 && sum > 0;
    }
    function mod11And10(value) {
      var length = value.length;
      var check = 5;
      for (var i = 0; i < length; i++) {
        check = ((check || 10) * 2 % 11 + parseInt(value.charAt(i), 10)) % 10;
      }
      return check === 1;
    }
    function mod37And36(value, alphabet) {
      if (alphabet === void 0) {
        alphabet = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
      }
      var length = value.length;
      var modulus = alphabet.length;
      var check = Math.floor(modulus / 2);
      for (var i = 0; i < length; i++) {
        check = ((check || modulus) * 2 % (modulus + 1) + alphabet.indexOf(value.charAt(i))) % modulus;
      }
      return check === 1;
    }
    function transform(input) {
      return input.split("").map(function(c) {
        var code = c.charCodeAt(0);
        return code >= 65 && code <= 90 ? (
          // Replace A, B, C, ..., Z with 10, 11, ..., 35
          code - 55
        ) : c;
      }).join("").split("").map(function(c) {
        return parseInt(c, 10);
      });
    }
    function mod97And10(input) {
      var digits = transform(input);
      var temp = 0;
      var length = digits.length;
      for (var i = 0; i < length - 1; ++i) {
        temp = (temp + digits[i]) * 10 % 97;
      }
      temp += digits[length - 1];
      return temp % 97 === 1;
    }
    function verhoeff(value) {
      var d = [
        [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
        [1, 2, 3, 4, 0, 6, 7, 8, 9, 5],
        [2, 3, 4, 0, 1, 7, 8, 9, 5, 6],
        [3, 4, 0, 1, 2, 8, 9, 5, 6, 7],
        [4, 0, 1, 2, 3, 9, 5, 6, 7, 8],
        [5, 9, 8, 7, 6, 0, 4, 3, 2, 1],
        [6, 5, 9, 8, 7, 1, 0, 4, 3, 2],
        [7, 6, 5, 9, 8, 2, 1, 0, 4, 3],
        [8, 7, 6, 5, 9, 3, 2, 1, 0, 4],
        [9, 8, 7, 6, 5, 4, 3, 2, 1, 0]
      ];
      var p = [
        [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
        [1, 5, 7, 6, 2, 8, 3, 0, 9, 4],
        [5, 8, 0, 3, 7, 9, 6, 1, 4, 2],
        [8, 9, 1, 6, 0, 4, 3, 5, 2, 7],
        [9, 4, 5, 3, 1, 2, 6, 8, 7, 0],
        [4, 2, 8, 6, 5, 7, 3, 9, 0, 1],
        [2, 7, 9, 3, 8, 0, 6, 4, 1, 5],
        [7, 0, 4, 6, 9, 1, 3, 2, 5, 8]
      ];
      var invertedArray = value.reverse();
      var c = 0;
      for (var i = 0; i < invertedArray.length; i++) {
        c = d[c][p[i % 8][invertedArray[i]]];
      }
      return c === 0;
    }
    var index$1 = {
      luhn,
      mod11And10,
      mod37And36,
      mod97And10,
      verhoeff
    };
    function __spreadArray(to, from, pack) {
      if (pack || arguments.length === 2)
        for (var i = 0, l = from.length, ar; i < l; i++) {
          if (ar || !(i in from)) {
            if (!ar)
              ar = Array.prototype.slice.call(from, 0, i);
            ar[i] = from[i];
          }
        }
      return to.concat(ar || Array.prototype.slice.call(from));
    }
    function getFieldValue(form, field, element, elements) {
      var type = (element.getAttribute("type") || "").toLowerCase();
      var tagName = element.tagName.toLowerCase();
      if (tagName === "textarea") {
        return element.value;
      }
      if (tagName === "select") {
        var select = element;
        var index2 = select.selectedIndex;
        return index2 >= 0 ? select.options.item(index2).value : "";
      }
      if (tagName === "input") {
        if ("radio" === type || "checkbox" === type) {
          var checked = elements.filter(function(ele) {
            return ele.checked;
          }).length;
          return checked === 0 ? "" : checked + "";
        } else {
          return element.value;
        }
      }
      return "";
    }
    function emitter() {
      return {
        fns: {},
        clear: function() {
          this.fns = {};
        },
        emit: function(event) {
          var args = [];
          for (var _i = 1; _i < arguments.length; _i++) {
            args[_i - 1] = arguments[_i];
          }
          (this.fns[event] || []).map(function(handler) {
            return handler.apply(handler, args);
          });
        },
        off: function(event, func) {
          if (this.fns[event]) {
            var index2 = this.fns[event].indexOf(func);
            if (index2 >= 0) {
              this.fns[event].splice(index2, 1);
            }
          }
        },
        on: function(event, func) {
          (this.fns[event] = this.fns[event] || []).push(func);
        }
      };
    }
    function filter() {
      return {
        filters: {},
        add: function(name, func) {
          (this.filters[name] = this.filters[name] || []).push(func);
        },
        clear: function() {
          this.filters = {};
        },
        execute: function(name, defaultValue, args) {
          if (!this.filters[name] || !this.filters[name].length) {
            return defaultValue;
          }
          var result = defaultValue;
          var filters = this.filters[name];
          var count = filters.length;
          for (var i = 0; i < count; i++) {
            result = filters[i].apply(result, args);
          }
          return result;
        },
        remove: function(name, func) {
          if (this.filters[name]) {
            this.filters[name] = this.filters[name].filter(function(f) {
              return f !== func;
            });
          }
        }
      };
    }
    var Core = (
      /** @class */
      function() {
        function Core2(form, fields) {
          this.fields = {};
          this.elements = {};
          this.ee = emitter();
          this.filter = filter();
          this.plugins = {};
          this.results = /* @__PURE__ */ new Map();
          this.validators = {};
          this.form = form;
          this.fields = fields;
        }
        Core2.prototype.on = function(event, func) {
          this.ee.on(event, func);
          return this;
        };
        Core2.prototype.off = function(event, func) {
          this.ee.off(event, func);
          return this;
        };
        Core2.prototype.emit = function(event) {
          var _a;
          var args = [];
          for (var _i = 1; _i < arguments.length; _i++) {
            args[_i - 1] = arguments[_i];
          }
          (_a = this.ee).emit.apply(_a, __spreadArray([event], args, false));
          return this;
        };
        Core2.prototype.registerPlugin = function(name, plugin) {
          if (this.plugins[name]) {
            throw new Error("The plguin ".concat(name, " is registered"));
          }
          plugin.setCore(this);
          plugin.install();
          this.plugins[name] = plugin;
          return this;
        };
        Core2.prototype.deregisterPlugin = function(name) {
          var plugin = this.plugins[name];
          if (plugin) {
            plugin.uninstall();
          }
          delete this.plugins[name];
          return this;
        };
        Core2.prototype.enablePlugin = function(name) {
          var plugin = this.plugins[name];
          if (plugin) {
            plugin.enable();
          }
          return this;
        };
        Core2.prototype.disablePlugin = function(name) {
          var plugin = this.plugins[name];
          if (plugin) {
            plugin.disable();
          }
          return this;
        };
        Core2.prototype.isPluginEnabled = function(name) {
          var plugin = this.plugins[name];
          return plugin ? plugin.isPluginEnabled() : false;
        };
        Core2.prototype.registerValidator = function(name, func) {
          if (this.validators[name]) {
            throw new Error("The validator ".concat(name, " is registered"));
          }
          this.validators[name] = func;
          return this;
        };
        Core2.prototype.registerFilter = function(name, func) {
          this.filter.add(name, func);
          return this;
        };
        Core2.prototype.deregisterFilter = function(name, func) {
          this.filter.remove(name, func);
          return this;
        };
        Core2.prototype.executeFilter = function(name, defaultValue, args) {
          return this.filter.execute(name, defaultValue, args);
        };
        Core2.prototype.addField = function(field, options) {
          var opts = Object.assign({}, {
            selector: "",
            validators: {}
          }, options);
          this.fields[field] = this.fields[field] ? {
            selector: opts.selector || this.fields[field].selector,
            validators: Object.assign({}, this.fields[field].validators, opts.validators)
          } : opts;
          this.elements[field] = this.queryElements(field);
          this.emit("core.field.added", {
            elements: this.elements[field],
            field,
            options: this.fields[field]
          });
          return this;
        };
        Core2.prototype.removeField = function(field) {
          if (!this.fields[field]) {
            throw new Error("The field ".concat(field, " validators are not defined. Please ensure the field is added first"));
          }
          var elements = this.elements[field];
          var options = this.fields[field];
          delete this.elements[field];
          delete this.fields[field];
          this.emit("core.field.removed", {
            elements,
            field,
            options
          });
          return this;
        };
        Core2.prototype.validate = function() {
          var _this = this;
          this.emit("core.form.validating", {
            formValidation: this
          });
          return this.filter.execute("validate-pre", Promise.resolve(), []).then(function() {
            return Promise.all(Object.keys(_this.fields).map(function(field) {
              return _this.validateField(field);
            })).then(function(results) {
              switch (true) {
                case results.indexOf("Invalid") !== -1:
                  _this.emit("core.form.invalid", {
                    formValidation: _this
                  });
                  return Promise.resolve("Invalid");
                case results.indexOf("NotValidated") !== -1:
                  _this.emit("core.form.notvalidated", {
                    formValidation: _this
                  });
                  return Promise.resolve("NotValidated");
                default:
                  _this.emit("core.form.valid", {
                    formValidation: _this
                  });
                  return Promise.resolve("Valid");
              }
            });
          });
        };
        Core2.prototype.validateField = function(field) {
          var _this = this;
          var result = this.results.get(field);
          if (result === "Valid" || result === "Invalid") {
            return Promise.resolve(result);
          }
          this.emit("core.field.validating", field);
          var elements = this.elements[field];
          if (elements.length === 0) {
            this.emit("core.field.valid", field);
            return Promise.resolve("Valid");
          }
          var type = elements[0].getAttribute("type");
          if ("radio" === type || "checkbox" === type || elements.length === 1) {
            return this.validateElement(field, elements[0]);
          } else {
            return Promise.all(elements.map(function(ele) {
              return _this.validateElement(field, ele);
            })).then(function(results) {
              switch (true) {
                case results.indexOf("Invalid") !== -1:
                  _this.emit("core.field.invalid", field);
                  _this.results.set(field, "Invalid");
                  return Promise.resolve("Invalid");
                case results.indexOf("NotValidated") !== -1:
                  _this.emit("core.field.notvalidated", field);
                  _this.results.delete(field);
                  return Promise.resolve("NotValidated");
                default:
                  _this.emit("core.field.valid", field);
                  _this.results.set(field, "Valid");
                  return Promise.resolve("Valid");
              }
            });
          }
        };
        Core2.prototype.validateElement = function(field, ele) {
          var _this = this;
          this.results.delete(field);
          var elements = this.elements[field];
          var ignored = this.filter.execute("element-ignored", false, [field, ele, elements]);
          if (ignored) {
            this.emit("core.element.ignored", {
              element: ele,
              elements,
              field
            });
            return Promise.resolve("Ignored");
          }
          var validatorList = this.fields[field].validators;
          this.emit("core.element.validating", {
            element: ele,
            elements,
            field
          });
          var promises = Object.keys(validatorList).map(function(v) {
            return function() {
              return _this.executeValidator(field, ele, v, validatorList[v]);
            };
          });
          return this.waterfall(promises).then(function(results) {
            var isValid = results.indexOf("Invalid") === -1;
            _this.emit("core.element.validated", {
              element: ele,
              elements,
              field,
              valid: isValid
            });
            var type = ele.getAttribute("type");
            if ("radio" === type || "checkbox" === type || elements.length === 1) {
              _this.emit(isValid ? "core.field.valid" : "core.field.invalid", field);
            }
            return Promise.resolve(isValid ? "Valid" : "Invalid");
          }).catch(function(reason) {
            _this.emit("core.element.notvalidated", {
              element: ele,
              elements,
              field
            });
            return Promise.resolve(reason);
          });
        };
        Core2.prototype.executeValidator = function(field, ele, v, opts) {
          var _this = this;
          var elements = this.elements[field];
          var name = this.filter.execute("validator-name", v, [v, field]);
          opts.message = this.filter.execute("validator-message", opts.message, [this.locale, field, name]);
          if (!this.validators[name] || opts.enabled === false) {
            this.emit("core.validator.validated", {
              element: ele,
              elements,
              field,
              result: this.normalizeResult(field, name, { valid: true }),
              validator: name
            });
            return Promise.resolve("Valid");
          }
          var validator = this.validators[name];
          var value = this.getElementValue(field, ele, name);
          var willValidate = this.filter.execute("field-should-validate", true, [field, ele, value, v]);
          if (!willValidate) {
            this.emit("core.validator.notvalidated", {
              element: ele,
              elements,
              field,
              validator: v
            });
            return Promise.resolve("NotValidated");
          }
          this.emit("core.validator.validating", {
            element: ele,
            elements,
            field,
            validator: v
          });
          var result = validator().validate({
            element: ele,
            elements,
            field,
            l10n: this.localization,
            options: opts,
            value
          });
          var isPromise = "function" === typeof result["then"];
          if (isPromise) {
            return result.then(function(r) {
              var data2 = _this.normalizeResult(field, v, r);
              _this.emit("core.validator.validated", {
                element: ele,
                elements,
                field,
                result: data2,
                validator: v
              });
              return data2.valid ? "Valid" : "Invalid";
            });
          } else {
            var data = this.normalizeResult(field, v, result);
            this.emit("core.validator.validated", {
              element: ele,
              elements,
              field,
              result: data,
              validator: v
            });
            return Promise.resolve(data.valid ? "Valid" : "Invalid");
          }
        };
        Core2.prototype.getElementValue = function(field, ele, validator) {
          var defaultValue = getFieldValue(this.form, field, ele, this.elements[field]);
          return this.filter.execute("field-value", defaultValue, [defaultValue, field, ele, validator]);
        };
        Core2.prototype.getElements = function(field) {
          return this.elements[field];
        };
        Core2.prototype.getFields = function() {
          return this.fields;
        };
        Core2.prototype.getFormElement = function() {
          return this.form;
        };
        Core2.prototype.getLocale = function() {
          return this.locale;
        };
        Core2.prototype.getPlugin = function(name) {
          return this.plugins[name];
        };
        Core2.prototype.updateFieldStatus = function(field, status, validator) {
          var _this = this;
          var elements = this.elements[field];
          var type = elements[0].getAttribute("type");
          var list = "radio" === type || "checkbox" === type ? [elements[0]] : elements;
          list.forEach(function(ele) {
            return _this.updateElementStatus(field, ele, status, validator);
          });
          if (!validator) {
            switch (status) {
              case "NotValidated":
                this.emit("core.field.notvalidated", field);
                this.results.delete(field);
                break;
              case "Validating":
                this.emit("core.field.validating", field);
                this.results.delete(field);
                break;
              case "Valid":
                this.emit("core.field.valid", field);
                this.results.set(field, "Valid");
                break;
              case "Invalid":
                this.emit("core.field.invalid", field);
                this.results.set(field, "Invalid");
                break;
            }
          } else if (status === "Invalid") {
            this.emit("core.field.invalid", field);
            this.results.set(field, "Invalid");
          }
          return this;
        };
        Core2.prototype.updateElementStatus = function(field, ele, status, validator) {
          var _this = this;
          var elements = this.elements[field];
          var fieldValidators = this.fields[field].validators;
          var validatorArr = validator ? [validator] : Object.keys(fieldValidators);
          switch (status) {
            case "NotValidated":
              validatorArr.forEach(function(v) {
                return _this.emit("core.validator.notvalidated", {
                  element: ele,
                  elements,
                  field,
                  validator: v
                });
              });
              this.emit("core.element.notvalidated", {
                element: ele,
                elements,
                field
              });
              break;
            case "Validating":
              validatorArr.forEach(function(v) {
                return _this.emit("core.validator.validating", {
                  element: ele,
                  elements,
                  field,
                  validator: v
                });
              });
              this.emit("core.element.validating", {
                element: ele,
                elements,
                field
              });
              break;
            case "Valid":
              validatorArr.forEach(function(v) {
                return _this.emit("core.validator.validated", {
                  element: ele,
                  elements,
                  field,
                  result: {
                    message: fieldValidators[v].message,
                    valid: true
                  },
                  validator: v
                });
              });
              this.emit("core.element.validated", {
                element: ele,
                elements,
                field,
                valid: true
              });
              break;
            case "Invalid":
              validatorArr.forEach(function(v) {
                return _this.emit("core.validator.validated", {
                  element: ele,
                  elements,
                  field,
                  result: {
                    message: fieldValidators[v].message,
                    valid: false
                  },
                  validator: v
                });
              });
              this.emit("core.element.validated", {
                element: ele,
                elements,
                field,
                valid: false
              });
              break;
          }
          return this;
        };
        Core2.prototype.resetForm = function(reset) {
          var _this = this;
          Object.keys(this.fields).forEach(function(field) {
            return _this.resetField(field, reset);
          });
          this.emit("core.form.reset", {
            formValidation: this,
            reset
          });
          return this;
        };
        Core2.prototype.resetField = function(field, reset) {
          if (reset) {
            var elements = this.elements[field];
            var type_1 = elements[0].getAttribute("type");
            elements.forEach(function(ele) {
              if ("radio" === type_1 || "checkbox" === type_1) {
                ele.removeAttribute("selected");
                ele.removeAttribute("checked");
                ele.checked = false;
              } else {
                ele.setAttribute("value", "");
                if (ele instanceof HTMLInputElement || ele instanceof HTMLTextAreaElement) {
                  ele.value = "";
                }
              }
            });
          }
          this.updateFieldStatus(field, "NotValidated");
          this.emit("core.field.reset", {
            field,
            reset
          });
          return this;
        };
        Core2.prototype.revalidateField = function(field) {
          if (!this.fields[field]) {
            return Promise.resolve("Ignored");
          }
          this.updateFieldStatus(field, "NotValidated");
          return this.validateField(field);
        };
        Core2.prototype.disableValidator = function(field, validator) {
          if (!this.fields[field]) {
            return this;
          }
          var elements = this.elements[field];
          this.toggleValidator(false, field, validator);
          this.emit("core.validator.disabled", {
            elements,
            field,
            formValidation: this,
            validator
          });
          return this;
        };
        Core2.prototype.enableValidator = function(field, validator) {
          if (!this.fields[field]) {
            return this;
          }
          var elements = this.elements[field];
          this.toggleValidator(true, field, validator);
          this.emit("core.validator.enabled", {
            elements,
            field,
            formValidation: this,
            validator
          });
          return this;
        };
        Core2.prototype.updateValidatorOption = function(field, validator, name, value) {
          if (this.fields[field] && this.fields[field].validators && this.fields[field].validators[validator]) {
            this.fields[field].validators[validator][name] = value;
          }
          return this;
        };
        Core2.prototype.setFieldOptions = function(field, options) {
          this.fields[field] = options;
          return this;
        };
        Core2.prototype.destroy = function() {
          var _this = this;
          Object.keys(this.plugins).forEach(function(id) {
            return _this.plugins[id].uninstall();
          });
          this.ee.clear();
          this.filter.clear();
          this.results.clear();
          this.plugins = {};
          return this;
        };
        Core2.prototype.setLocale = function(locale, localization) {
          this.locale = locale;
          this.localization = localization;
          return this;
        };
        Core2.prototype.waterfall = function(promises) {
          return promises.reduce(function(p, c) {
            return p.then(function(res) {
              return c().then(function(result) {
                res.push(result);
                return res;
              });
            });
          }, Promise.resolve([]));
        };
        Core2.prototype.queryElements = function(field) {
          var selector = this.fields[field].selector ? (
            // Check if the selector is an ID selector which starts with `#`
            "#" === this.fields[field].selector.charAt(0) ? '[id="'.concat(this.fields[field].selector.substring(1), '"]') : this.fields[field].selector
          ) : '[name="'.concat(field.replace(/"/g, '\\"'), '"]');
          return [].slice.call(this.form.querySelectorAll(selector));
        };
        Core2.prototype.normalizeResult = function(field, validator, result) {
          var opts = this.fields[field].validators[validator];
          return Object.assign({}, result, {
            message: result.message || (opts ? opts.message : "") || (this.localization && this.localization[validator] && this.localization[validator]["default"] ? this.localization[validator]["default"] : "") || "The field ".concat(field, " is not valid")
          });
        };
        Core2.prototype.toggleValidator = function(enabled, field, validator) {
          var _this = this;
          var validatorArr = this.fields[field].validators;
          if (validator && validatorArr && validatorArr[validator]) {
            this.fields[field].validators[validator].enabled = enabled;
          } else if (!validator) {
            Object.keys(validatorArr).forEach(function(v) {
              return _this.fields[field].validators[v].enabled = enabled;
            });
          }
          return this.updateFieldStatus(field, "NotValidated", validator);
        };
        return Core2;
      }()
    );
    function formValidation(form, options) {
      var opts = Object.assign({}, {
        fields: {},
        locale: "en_US",
        plugins: {},
        init: function(_) {
        }
      }, options);
      var core = new Core(form, opts.fields);
      core.setLocale(opts.locale, opts.localization);
      Object.keys(opts.plugins).forEach(function(name) {
        return core.registerPlugin(name, opts.plugins[name]);
      });
      opts.init(core);
      Object.keys(opts.fields).forEach(function(field) {
        return core.addField(field, opts.fields[field]);
      });
      return core;
    }
    var Plugin = (
      /** @class */
      function() {
        function Plugin2(opts) {
          this.opts = opts;
          this.isEnabled = true;
        }
        Plugin2.prototype.setCore = function(core) {
          this.core = core;
          return this;
        };
        Plugin2.prototype.enable = function() {
          this.isEnabled = true;
          this.onEnabled();
          return this;
        };
        Plugin2.prototype.disable = function() {
          this.isEnabled = false;
          this.onDisabled();
          return this;
        };
        Plugin2.prototype.isPluginEnabled = function() {
          return this.isEnabled;
        };
        Plugin2.prototype.onEnabled = function() {
        };
        Plugin2.prototype.onDisabled = function() {
        };
        Plugin2.prototype.install = function() {
        };
        Plugin2.prototype.uninstall = function() {
        };
        return Plugin2;
      }()
    );
    function call(functionName, args) {
      if ("function" === typeof functionName) {
        return functionName.apply(this, args);
      } else if ("string" === typeof functionName) {
        var name_1 = functionName;
        if ("()" === name_1.substring(name_1.length - 2)) {
          name_1 = name_1.substring(0, name_1.length - 2);
        }
        var ns = name_1.split(".");
        var func = ns.pop();
        var context_1 = window;
        for (var _i = 0, ns_1 = ns; _i < ns_1.length; _i++) {
          var t = ns_1[_i];
          context_1 = context_1[t];
        }
        return typeof context_1[func] === "undefined" ? null : context_1[func].apply(this, args);
      }
    }
    var addClass = function(element, classes) {
      classes.split(" ").forEach(function(clazz) {
        if (element.classList) {
          element.classList.add(clazz);
        } else if (" ".concat(element.className, " ").indexOf(" ".concat(clazz, " "))) {
          element.className += " ".concat(clazz);
        }
      });
    };
    var removeClass = function(element, classes) {
      classes.split(" ").forEach(function(clazz) {
        element.classList ? element.classList.remove(clazz) : element.className = element.className.replace(clazz, "");
      });
    };
    var classSet = function(element, classes) {
      var adding = [];
      var removing = [];
      Object.keys(classes).forEach(function(clazz) {
        if (clazz) {
          classes[clazz] ? adding.push(clazz) : removing.push(clazz);
        }
      });
      removing.forEach(function(clazz) {
        return removeClass(element, clazz);
      });
      adding.forEach(function(clazz) {
        return addClass(element, clazz);
      });
    };
    var matches = function(element, selector) {
      var nativeMatches = element.matches || element.webkitMatchesSelector || element["mozMatchesSelector"] || element["msMatchesSelector"];
      if (nativeMatches) {
        return nativeMatches.call(element, selector);
      }
      var nodes = [].slice.call(element.parentElement.querySelectorAll(selector));
      return nodes.indexOf(element) >= 0;
    };
    var closest = function(element, selector) {
      var ele = element;
      while (ele) {
        if (matches(ele, selector)) {
          break;
        }
        ele = ele.parentElement;
      }
      return ele;
    };
    var generateString = function(length) {
      return Array(length).fill("").map(function(v) {
        return Math.random().toString(36).charAt(2);
      }).join("");
    };
    var fetch = function(url, options) {
      var toQuery = function(obj) {
        return Object.keys(obj).map(function(k) {
          return "".concat(encodeURIComponent(k), "=").concat(encodeURIComponent(obj[k]));
        }).join("&");
      };
      return new Promise(function(resolve, reject) {
        var opts = Object.assign({}, {
          crossDomain: false,
          headers: {},
          method: "GET",
          params: {}
        }, options);
        var params = Object.keys(opts.params).map(function(k) {
          return "".concat(encodeURIComponent(k), "=").concat(encodeURIComponent(opts.params[k]));
        }).join("&");
        var hasQuery = url.indexOf("?") > -1;
        var requestUrl = "GET" === opts.method ? "".concat(url).concat(hasQuery ? "&" : "?").concat(params) : url;
        if (opts.crossDomain) {
          var script_1 = document.createElement("script");
          var callback_1 = "___FormValidationFetch_".concat(generateString(12), "___");
          window[callback_1] = function(data) {
            delete window[callback_1];
            resolve(data);
          };
          script_1.src = "".concat(requestUrl).concat(hasQuery ? "&" : "?", "callback=").concat(callback_1);
          script_1.async = true;
          script_1.addEventListener("load", function() {
            script_1.parentNode.removeChild(script_1);
          });
          script_1.addEventListener("error", function() {
            return reject;
          });
          document.head.appendChild(script_1);
        } else {
          var request_1 = new XMLHttpRequest();
          request_1.open(opts.method, requestUrl);
          request_1.setRequestHeader("X-Requested-With", "XMLHttpRequest");
          if ("POST" === opts.method) {
            request_1.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
          }
          Object.keys(opts.headers).forEach(function(k) {
            return request_1.setRequestHeader(k, opts.headers[k]);
          });
          request_1.addEventListener("load", function() {
            resolve(JSON.parse(this.responseText));
          });
          request_1.addEventListener("error", function() {
            return reject;
          });
          request_1.send(toQuery(opts.params));
        }
      });
    };
    var format = function(message, parameters) {
      var params = Array.isArray(parameters) ? parameters : [parameters];
      var output = message;
      params.forEach(function(p) {
        output = output.replace("%s", p);
      });
      return output;
    };
    var hasClass = function(element, clazz) {
      return element.classList ? element.classList.contains(clazz) : new RegExp("(^| )".concat(clazz, "( |$)"), "gi").test(element.className);
    };
    var isValidDate = function(year, month, day, notInFuture) {
      if (isNaN(year) || isNaN(month) || isNaN(day)) {
        return false;
      }
      if (year < 1e3 || year > 9999 || month <= 0 || month > 12) {
        return false;
      }
      var numDays = [
        31,
        // Update the number of days in Feb of leap year
        year % 400 === 0 || year % 100 !== 0 && year % 4 === 0 ? 29 : 28,
        31,
        30,
        31,
        30,
        31,
        31,
        30,
        31,
        30,
        31
      ];
      if (day <= 0 || day > numDays[month - 1]) {
        return false;
      }
      if (notInFuture === true) {
        var currentDate = /* @__PURE__ */ new Date();
        var currentYear = currentDate.getFullYear();
        var currentMonth = currentDate.getMonth();
        var currentDay = currentDate.getDate();
        return year < currentYear || year === currentYear && month - 1 < currentMonth || year === currentYear && month - 1 === currentMonth && day < currentDay;
      }
      return true;
    };
    var removeUndefined = function(obj) {
      return obj ? Object.entries(obj).reduce(function(a, _a) {
        var k = _a[0], v = _a[1];
        return v === void 0 ? a : (a[k] = v, a);
      }, {}) : {};
    };
    var index = {
      call,
      classSet,
      closest,
      fetch,
      format,
      hasClass,
      isValidDate,
      removeUndefined
    };
    exports.Plugin = Plugin;
    exports.algorithms = index$1;
    exports.formValidation = formValidation;
    exports.utils = index;
  }
});

// node_modules/@form-validation/core/lib/index.js
var require_lib = __commonJS({
  "node_modules/@form-validation/core/lib/index.js"(exports, module) {
    "use strict";
    if (false) {
      module.exports = null;
    } else {
      module.exports = require_cjs();
    }
  }
});

export {
  require_lib
};
//# sourceMappingURL=chunk-ZKBBKPD4.js.map
