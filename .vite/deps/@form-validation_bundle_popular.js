import {
  __commonJS
} from "./chunk-GFT2G5UO.js";

// node_modules/@form-validation/bundle/lib/cjs/popular.js
var require_popular = __commonJS({
  "node_modules/@form-validation/bundle/lib/cjs/popular.js"(exports) {
    "use strict";
    var lib$B = { exports: {} };
    var cjs$B = {};
    var hasRequiredCjs$B;
    function requireCjs$B() {
      if (hasRequiredCjs$B)
        return cjs$B;
      hasRequiredCjs$B = 1;
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
      cjs$B.Plugin = Plugin;
      cjs$B.algorithms = index$1;
      cjs$B.formValidation = formValidation;
      cjs$B.utils = index;
      return cjs$B;
    }
    if (false) {
      lib$B.exports = requireIndex_min$B();
    } else {
      lib$B.exports = requireCjs$B();
    }
    var libExports$B = lib$B.exports;
    var lib$A = { exports: {} };
    var cjs$A = {};
    var hasRequiredCjs$A;
    function requireCjs$A() {
      if (hasRequiredCjs$A)
        return cjs$A;
      hasRequiredCjs$A = 1;
      var core = libExports$B;
      var extendStatics = function(d, b) {
        extendStatics = Object.setPrototypeOf || { __proto__: [] } instanceof Array && function(d2, b2) {
          d2.__proto__ = b2;
        } || function(d2, b2) {
          for (var p in b2)
            if (Object.prototype.hasOwnProperty.call(b2, p))
              d2[p] = b2[p];
        };
        return extendStatics(d, b);
      };
      function __extends(d, b) {
        if (typeof b !== "function" && b !== null)
          throw new TypeError("Class extends value " + String(b) + " is not a constructor or null");
        extendStatics(d, b);
        function __() {
          this.constructor = d;
        }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
      }
      var Alias = (
        /** @class */
        function(_super) {
          __extends(Alias2, _super);
          function Alias2(opts) {
            var _this = _super.call(this, opts) || this;
            _this.opts = opts || {};
            _this.validatorNameFilter = _this.getValidatorName.bind(_this);
            return _this;
          }
          Alias2.prototype.install = function() {
            this.core.registerFilter("validator-name", this.validatorNameFilter);
          };
          Alias2.prototype.uninstall = function() {
            this.core.deregisterFilter("validator-name", this.validatorNameFilter);
          };
          Alias2.prototype.getValidatorName = function(validatorName, _field) {
            return this.isEnabled ? this.opts[validatorName] || validatorName : validatorName;
          };
          return Alias2;
        }(core.Plugin)
      );
      cjs$A.Alias = Alias;
      return cjs$A;
    }
    if (false) {
      lib$A.exports = requireIndex_min$A();
    } else {
      lib$A.exports = requireCjs$A();
    }
    var libExports$A = lib$A.exports;
    var lib$z = { exports: {} };
    var cjs$z = {};
    var hasRequiredCjs$z;
    function requireCjs$z() {
      if (hasRequiredCjs$z)
        return cjs$z;
      hasRequiredCjs$z = 1;
      var core = libExports$B;
      var extendStatics = function(d, b) {
        extendStatics = Object.setPrototypeOf || { __proto__: [] } instanceof Array && function(d2, b2) {
          d2.__proto__ = b2;
        } || function(d2, b2) {
          for (var p in b2)
            if (Object.prototype.hasOwnProperty.call(b2, p))
              d2[p] = b2[p];
        };
        return extendStatics(d, b);
      };
      function __extends(d, b) {
        if (typeof b !== "function" && b !== null)
          throw new TypeError("Class extends value " + String(b) + " is not a constructor or null");
        extendStatics(d, b);
        function __() {
          this.constructor = d;
        }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
      }
      var Aria = (
        /** @class */
        function(_super) {
          __extends(Aria2, _super);
          function Aria2() {
            var _this = _super.call(this, {}) || this;
            _this.elementValidatedHandler = _this.onElementValidated.bind(_this);
            _this.fieldValidHandler = _this.onFieldValid.bind(_this);
            _this.fieldInvalidHandler = _this.onFieldInvalid.bind(_this);
            _this.messageDisplayedHandler = _this.onMessageDisplayed.bind(_this);
            return _this;
          }
          Aria2.prototype.install = function() {
            this.core.on("core.field.valid", this.fieldValidHandler).on("core.field.invalid", this.fieldInvalidHandler).on("core.element.validated", this.elementValidatedHandler).on("plugins.message.displayed", this.messageDisplayedHandler);
          };
          Aria2.prototype.uninstall = function() {
            this.core.off("core.field.valid", this.fieldValidHandler).off("core.field.invalid", this.fieldInvalidHandler).off("core.element.validated", this.elementValidatedHandler).off("plugins.message.displayed", this.messageDisplayedHandler);
          };
          Aria2.prototype.onElementValidated = function(e) {
            if (e.valid) {
              e.element.setAttribute("aria-invalid", "false");
              e.element.removeAttribute("aria-describedby");
            }
          };
          Aria2.prototype.onFieldValid = function(field) {
            var elements = this.core.getElements(field);
            if (elements) {
              elements.forEach(function(ele) {
                ele.setAttribute("aria-invalid", "false");
                ele.removeAttribute("aria-describedby");
              });
            }
          };
          Aria2.prototype.onFieldInvalid = function(field) {
            var elements = this.core.getElements(field);
            if (elements) {
              elements.forEach(function(ele) {
                return ele.setAttribute("aria-invalid", "true");
              });
            }
          };
          Aria2.prototype.onMessageDisplayed = function(e) {
            e.messageElement.setAttribute("role", "alert");
            e.messageElement.setAttribute("aria-hidden", "false");
            var elements = this.core.getElements(e.field);
            var index = elements.indexOf(e.element);
            var id = "js-fv-".concat(e.field, "-").concat(index, "-").concat(Date.now(), "-message");
            e.messageElement.setAttribute("id", id);
            e.element.setAttribute("aria-describedby", id);
            var type = e.element.getAttribute("type");
            if ("radio" === type || "checkbox" === type) {
              elements.forEach(function(ele) {
                return ele.setAttribute("aria-describedby", id);
              });
            }
          };
          return Aria2;
        }(core.Plugin)
      );
      cjs$z.Aria = Aria;
      return cjs$z;
    }
    if (false) {
      lib$z.exports = requireIndex_min$z();
    } else {
      lib$z.exports = requireCjs$z();
    }
    var libExports$z = lib$z.exports;
    var lib$y = { exports: {} };
    var cjs$y = {};
    var hasRequiredCjs$y;
    function requireCjs$y() {
      if (hasRequiredCjs$y)
        return cjs$y;
      hasRequiredCjs$y = 1;
      var core = libExports$B;
      var extendStatics = function(d, b) {
        extendStatics = Object.setPrototypeOf || { __proto__: [] } instanceof Array && function(d2, b2) {
          d2.__proto__ = b2;
        } || function(d2, b2) {
          for (var p in b2)
            if (Object.prototype.hasOwnProperty.call(b2, p))
              d2[p] = b2[p];
        };
        return extendStatics(d, b);
      };
      function __extends(d, b) {
        if (typeof b !== "function" && b !== null)
          throw new TypeError("Class extends value " + String(b) + " is not a constructor or null");
        extendStatics(d, b);
        function __() {
          this.constructor = d;
        }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
      }
      var Declarative = (
        /** @class */
        function(_super) {
          __extends(Declarative2, _super);
          function Declarative2(opts) {
            var _this = _super.call(this, opts) || this;
            _this.addedFields = /* @__PURE__ */ new Map();
            _this.opts = Object.assign({}, {
              html5Input: false,
              pluginPrefix: "data-fvp-",
              prefix: "data-fv-"
            }, opts);
            _this.fieldAddedHandler = _this.onFieldAdded.bind(_this);
            _this.fieldRemovedHandler = _this.onFieldRemoved.bind(_this);
            return _this;
          }
          Declarative2.prototype.install = function() {
            var _this = this;
            this.parsePlugins();
            var opts = this.parseOptions();
            Object.keys(opts).forEach(function(field) {
              if (!_this.addedFields.has(field)) {
                _this.addedFields.set(field, true);
              }
              _this.core.addField(field, opts[field]);
            });
            this.core.on("core.field.added", this.fieldAddedHandler).on("core.field.removed", this.fieldRemovedHandler);
          };
          Declarative2.prototype.uninstall = function() {
            this.addedFields.clear();
            this.core.off("core.field.added", this.fieldAddedHandler).off("core.field.removed", this.fieldRemovedHandler);
          };
          Declarative2.prototype.onFieldAdded = function(e) {
            var _this = this;
            var elements = e.elements;
            if (!elements || elements.length === 0 || this.addedFields.has(e.field)) {
              return;
            }
            this.addedFields.set(e.field, true);
            elements.forEach(function(ele) {
              var declarativeOptions = _this.parseElement(ele);
              if (!_this.isEmptyOption(declarativeOptions)) {
                var mergeOptions = {
                  selector: e.options.selector,
                  validators: Object.assign({}, e.options.validators || {}, declarativeOptions.validators)
                };
                _this.core.setFieldOptions(e.field, mergeOptions);
              }
            });
          };
          Declarative2.prototype.onFieldRemoved = function(e) {
            if (e.field && this.addedFields.has(e.field)) {
              this.addedFields.delete(e.field);
            }
          };
          Declarative2.prototype.parseOptions = function() {
            var _this = this;
            var prefix = this.opts.prefix;
            var opts = {};
            var fields = this.core.getFields();
            var form = this.core.getFormElement();
            var elements = [].slice.call(form.querySelectorAll("[name], [".concat(prefix, "field]")));
            elements.forEach(function(ele) {
              var validators2 = _this.parseElement(ele);
              if (!_this.isEmptyOption(validators2)) {
                var field = ele.getAttribute("name") || ele.getAttribute("".concat(prefix, "field"));
                opts[field] = Object.assign({}, opts[field], validators2);
              }
            });
            Object.keys(opts).forEach(function(field) {
              Object.keys(opts[field].validators).forEach(function(v) {
                opts[field].validators[v].enabled = opts[field].validators[v].enabled || false;
                if (fields[field] && fields[field].validators && fields[field].validators[v]) {
                  Object.assign(opts[field].validators[v], fields[field].validators[v]);
                }
              });
            });
            return Object.assign({}, fields, opts);
          };
          Declarative2.prototype.createPluginInstance = function(clazz, opts) {
            var arr = clazz.split(".");
            var fn = window || this;
            for (var i = 0, len = arr.length; i < len; i++) {
              fn = fn[arr[i]];
            }
            if (typeof fn !== "function") {
              throw new Error("the plugin ".concat(clazz, " doesn't exist"));
            }
            return new fn(opts);
          };
          Declarative2.prototype.parsePlugins = function() {
            var _a;
            var _this = this;
            var form = this.core.getFormElement();
            var reg = new RegExp("^".concat(this.opts.pluginPrefix, "([a-z0-9-]+)(___)*([a-z0-9-]+)*$"));
            var numAttributes = form.attributes.length;
            var plugins2 = {};
            for (var i = 0; i < numAttributes; i++) {
              var name_1 = form.attributes[i].name;
              var value = form.attributes[i].value;
              var items = reg.exec(name_1);
              if (items && items.length === 4) {
                var pluginName = this.toCamelCase(items[1]);
                plugins2[pluginName] = Object.assign({}, items[3] ? (_a = {}, _a[this.toCamelCase(items[3])] = value, _a) : { enabled: "" === value || "true" === value }, plugins2[pluginName]);
              }
            }
            Object.keys(plugins2).forEach(function(pluginName2) {
              var opts = plugins2[pluginName2];
              var enabled = opts["enabled"];
              var clazz = opts["class"];
              if (enabled && clazz) {
                delete opts["enabled"];
                delete opts["clazz"];
                var p = _this.createPluginInstance(clazz, opts);
                _this.core.registerPlugin(pluginName2, p);
              }
            });
          };
          Declarative2.prototype.isEmptyOption = function(opts) {
            var validators2 = opts.validators;
            return Object.keys(validators2).length === 0 && validators2.constructor === Object;
          };
          Declarative2.prototype.parseElement = function(ele) {
            var reg = new RegExp("^".concat(this.opts.prefix, "([a-z0-9-]+)(___)*([a-z0-9-]+)*$"));
            var numAttributes = ele.attributes.length;
            var opts = {};
            var type = ele.getAttribute("type");
            for (var i = 0; i < numAttributes; i++) {
              var name_2 = ele.attributes[i].name;
              var value = ele.attributes[i].value;
              if (this.opts.html5Input) {
                switch (true) {
                  case "minlength" === name_2:
                    opts["stringLength"] = Object.assign({}, {
                      enabled: true,
                      min: parseInt(value, 10)
                    }, opts["stringLength"]);
                    break;
                  case "maxlength" === name_2:
                    opts["stringLength"] = Object.assign({}, {
                      enabled: true,
                      max: parseInt(value, 10)
                    }, opts["stringLength"]);
                    break;
                  case "pattern" === name_2:
                    opts["regexp"] = Object.assign({}, {
                      enabled: true,
                      regexp: value
                    }, opts["regexp"]);
                    break;
                  case "required" === name_2:
                    opts["notEmpty"] = Object.assign({}, {
                      enabled: true
                    }, opts["notEmpty"]);
                    break;
                  case ("type" === name_2 && "color" === value):
                    opts["color"] = Object.assign({}, {
                      enabled: true,
                      type: "hex"
                    }, opts["color"]);
                    break;
                  case ("type" === name_2 && "email" === value):
                    opts["emailAddress"] = Object.assign({}, {
                      enabled: true
                    }, opts["emailAddress"]);
                    break;
                  case ("type" === name_2 && "url" === value):
                    opts["uri"] = Object.assign({}, {
                      enabled: true
                    }, opts["uri"]);
                    break;
                  case ("type" === name_2 && "range" === value):
                    opts["between"] = Object.assign({}, {
                      enabled: true,
                      max: parseFloat(ele.getAttribute("max")),
                      min: parseFloat(ele.getAttribute("min"))
                    }, opts["between"]);
                    break;
                  case ("min" === name_2 && type !== "date" && type !== "range"):
                    opts["greaterThan"] = Object.assign({}, {
                      enabled: true,
                      min: parseFloat(value)
                    }, opts["greaterThan"]);
                    break;
                  case ("max" === name_2 && type !== "date" && type !== "range"):
                    opts["lessThan"] = Object.assign({}, {
                      enabled: true,
                      max: parseFloat(value)
                    }, opts["lessThan"]);
                    break;
                }
              }
              var items = reg.exec(name_2);
              if (items && items.length === 4) {
                var v = this.toCamelCase(items[1]);
                if (!opts[v]) {
                  opts[v] = {};
                }
                if (items[3]) {
                  opts[v][this.toCamelCase(items[3])] = this.normalizeValue(value);
                } else if (opts[v]["enabled"] !== true || opts[v]["enabled"] !== false) {
                  opts[v]["enabled"] = "" === value || "true" === value;
                }
              }
            }
            return { validators: opts };
          };
          Declarative2.prototype.normalizeValue = function(value) {
            return value === "true" || value === "" ? true : value === "false" ? false : value;
          };
          Declarative2.prototype.toUpperCase = function(input) {
            return input.charAt(1).toUpperCase();
          };
          Declarative2.prototype.toCamelCase = function(input) {
            return input.replace(/-./g, this.toUpperCase);
          };
          return Declarative2;
        }(core.Plugin)
      );
      cjs$y.Declarative = Declarative;
      return cjs$y;
    }
    if (false) {
      lib$y.exports = requireIndex_min$y();
    } else {
      lib$y.exports = requireCjs$y();
    }
    var libExports$y = lib$y.exports;
    var lib$x = { exports: {} };
    var cjs$x = {};
    var hasRequiredCjs$x;
    function requireCjs$x() {
      if (hasRequiredCjs$x)
        return cjs$x;
      hasRequiredCjs$x = 1;
      var core = libExports$B;
      var extendStatics = function(d, b) {
        extendStatics = Object.setPrototypeOf || { __proto__: [] } instanceof Array && function(d2, b2) {
          d2.__proto__ = b2;
        } || function(d2, b2) {
          for (var p in b2)
            if (Object.prototype.hasOwnProperty.call(b2, p))
              d2[p] = b2[p];
        };
        return extendStatics(d, b);
      };
      function __extends(d, b) {
        if (typeof b !== "function" && b !== null)
          throw new TypeError("Class extends value " + String(b) + " is not a constructor or null");
        extendStatics(d, b);
        function __() {
          this.constructor = d;
        }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
      }
      var DefaultSubmit = (
        /** @class */
        function(_super) {
          __extends(DefaultSubmit2, _super);
          function DefaultSubmit2() {
            var _this = _super.call(this, {}) || this;
            _this.onValidHandler = _this.onFormValid.bind(_this);
            return _this;
          }
          DefaultSubmit2.prototype.install = function() {
            var form = this.core.getFormElement();
            if (form.querySelectorAll('[type="submit"][name="submit"]').length) {
              throw new Error("Do not use `submit` for the name attribute of submit button");
            }
            this.core.on("core.form.valid", this.onValidHandler);
          };
          DefaultSubmit2.prototype.uninstall = function() {
            this.core.off("core.form.valid", this.onValidHandler);
          };
          DefaultSubmit2.prototype.onFormValid = function() {
            var form = this.core.getFormElement();
            if (this.isEnabled && form instanceof HTMLFormElement) {
              form.submit();
            }
          };
          return DefaultSubmit2;
        }(core.Plugin)
      );
      cjs$x.DefaultSubmit = DefaultSubmit;
      return cjs$x;
    }
    if (false) {
      lib$x.exports = requireIndex_min$x();
    } else {
      lib$x.exports = requireCjs$x();
    }
    var libExports$x = lib$x.exports;
    var lib$w = { exports: {} };
    var cjs$w = {};
    var hasRequiredCjs$w;
    function requireCjs$w() {
      if (hasRequiredCjs$w)
        return cjs$w;
      hasRequiredCjs$w = 1;
      var core = libExports$B;
      var extendStatics = function(d, b) {
        extendStatics = Object.setPrototypeOf || { __proto__: [] } instanceof Array && function(d2, b2) {
          d2.__proto__ = b2;
        } || function(d2, b2) {
          for (var p in b2)
            if (Object.prototype.hasOwnProperty.call(b2, p))
              d2[p] = b2[p];
        };
        return extendStatics(d, b);
      };
      function __extends(d, b) {
        if (typeof b !== "function" && b !== null)
          throw new TypeError("Class extends value " + String(b) + " is not a constructor or null");
        extendStatics(d, b);
        function __() {
          this.constructor = d;
        }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
      }
      var Dependency = (
        /** @class */
        function(_super) {
          __extends(Dependency2, _super);
          function Dependency2(opts) {
            var _this = _super.call(this, opts) || this;
            _this.opts = opts || {};
            _this.triggerExecutedHandler = _this.onTriggerExecuted.bind(_this);
            return _this;
          }
          Dependency2.prototype.install = function() {
            this.core.on("plugins.trigger.executed", this.triggerExecutedHandler);
          };
          Dependency2.prototype.uninstall = function() {
            this.core.off("plugins.trigger.executed", this.triggerExecutedHandler);
          };
          Dependency2.prototype.onTriggerExecuted = function(e) {
            if (this.isEnabled && this.opts[e.field]) {
              var dependencies = this.opts[e.field].split(" ");
              for (var _i = 0, dependencies_1 = dependencies; _i < dependencies_1.length; _i++) {
                var d = dependencies_1[_i];
                var dependentField = d.trim();
                if (this.opts[dependentField]) {
                  this.core.revalidateField(dependentField);
                }
              }
            }
          };
          return Dependency2;
        }(core.Plugin)
      );
      cjs$w.Dependency = Dependency;
      return cjs$w;
    }
    if (false) {
      lib$w.exports = requireIndex_min$w();
    } else {
      lib$w.exports = requireCjs$w();
    }
    var libExports$w = lib$w.exports;
    var lib$v = { exports: {} };
    var cjs$v = {};
    var hasRequiredCjs$v;
    function requireCjs$v() {
      if (hasRequiredCjs$v)
        return cjs$v;
      hasRequiredCjs$v = 1;
      var core = libExports$B;
      var extendStatics = function(d, b) {
        extendStatics = Object.setPrototypeOf || { __proto__: [] } instanceof Array && function(d2, b2) {
          d2.__proto__ = b2;
        } || function(d2, b2) {
          for (var p in b2)
            if (Object.prototype.hasOwnProperty.call(b2, p))
              d2[p] = b2[p];
        };
        return extendStatics(d, b);
      };
      function __extends(d, b) {
        if (typeof b !== "function" && b !== null)
          throw new TypeError("Class extends value " + String(b) + " is not a constructor or null");
        extendStatics(d, b);
        function __() {
          this.constructor = d;
        }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
      }
      var removeUndefined = core.utils.removeUndefined;
      var Excluded = (
        /** @class */
        function(_super) {
          __extends(Excluded2, _super);
          function Excluded2(opts) {
            var _this = _super.call(this, opts) || this;
            _this.opts = Object.assign({}, { excluded: Excluded2.defaultIgnore }, removeUndefined(opts));
            _this.ignoreValidationFilter = _this.ignoreValidation.bind(_this);
            return _this;
          }
          Excluded2.defaultIgnore = function(_field, element, _elements) {
            var isVisible = !!(element.offsetWidth || element.offsetHeight || element.getClientRects().length);
            var disabled = element.getAttribute("disabled");
            return disabled === "" || disabled === "disabled" || element.getAttribute("type") === "hidden" || !isVisible;
          };
          Excluded2.prototype.install = function() {
            this.core.registerFilter("element-ignored", this.ignoreValidationFilter);
          };
          Excluded2.prototype.uninstall = function() {
            this.core.deregisterFilter("element-ignored", this.ignoreValidationFilter);
          };
          Excluded2.prototype.ignoreValidation = function(field, element, elements) {
            if (!this.isEnabled) {
              return false;
            }
            return this.opts.excluded.apply(this, [field, element, elements]);
          };
          return Excluded2;
        }(core.Plugin)
      );
      cjs$v.Excluded = Excluded;
      return cjs$v;
    }
    if (false) {
      lib$v.exports = requireIndex_min$v();
    } else {
      lib$v.exports = requireCjs$v();
    }
    var libExports$v = lib$v.exports;
    var lib$u = { exports: {} };
    var cjs$u = {};
    var hasRequiredCjs$u;
    function requireCjs$u() {
      if (hasRequiredCjs$u)
        return cjs$u;
      hasRequiredCjs$u = 1;
      var core = libExports$B;
      var extendStatics = function(d, b) {
        extendStatics = Object.setPrototypeOf || { __proto__: [] } instanceof Array && function(d2, b2) {
          d2.__proto__ = b2;
        } || function(d2, b2) {
          for (var p in b2)
            if (Object.prototype.hasOwnProperty.call(b2, p))
              d2[p] = b2[p];
        };
        return extendStatics(d, b);
      };
      function __extends(d, b) {
        if (typeof b !== "function" && b !== null)
          throw new TypeError("Class extends value " + String(b) + " is not a constructor or null");
        extendStatics(d, b);
        function __() {
          this.constructor = d;
        }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
      }
      var FieldStatus = (
        /** @class */
        function(_super) {
          __extends(FieldStatus2, _super);
          function FieldStatus2(opts) {
            var _this = _super.call(this, opts) || this;
            _this.statuses = /* @__PURE__ */ new Map();
            _this.opts = Object.assign({}, {
              onStatusChanged: function() {
              }
            }, opts);
            _this.elementValidatingHandler = _this.onElementValidating.bind(_this);
            _this.elementValidatedHandler = _this.onElementValidated.bind(_this);
            _this.elementNotValidatedHandler = _this.onElementNotValidated.bind(_this);
            _this.elementIgnoredHandler = _this.onElementIgnored.bind(_this);
            _this.fieldAddedHandler = _this.onFieldAdded.bind(_this);
            _this.fieldRemovedHandler = _this.onFieldRemoved.bind(_this);
            return _this;
          }
          FieldStatus2.prototype.install = function() {
            this.core.on("core.element.validating", this.elementValidatingHandler).on("core.element.validated", this.elementValidatedHandler).on("core.element.notvalidated", this.elementNotValidatedHandler).on("core.element.ignored", this.elementIgnoredHandler).on("core.field.added", this.fieldAddedHandler).on("core.field.removed", this.fieldRemovedHandler);
          };
          FieldStatus2.prototype.uninstall = function() {
            this.statuses.clear();
            this.core.off("core.element.validating", this.elementValidatingHandler).off("core.element.validated", this.elementValidatedHandler).off("core.element.notvalidated", this.elementNotValidatedHandler).off("core.element.ignored", this.elementIgnoredHandler).off("core.field.added", this.fieldAddedHandler).off("core.field.removed", this.fieldRemovedHandler);
          };
          FieldStatus2.prototype.areFieldsValid = function() {
            return Array.from(this.statuses.values()).every(function(value) {
              return value === "Valid" || value === "NotValidated" || value === "Ignored";
            });
          };
          FieldStatus2.prototype.getStatuses = function() {
            return this.isEnabled ? this.statuses : /* @__PURE__ */ new Map();
          };
          FieldStatus2.prototype.onFieldAdded = function(e) {
            this.statuses.set(e.field, "NotValidated");
          };
          FieldStatus2.prototype.onFieldRemoved = function(e) {
            if (this.statuses.has(e.field)) {
              this.statuses.delete(e.field);
            }
            this.handleStatusChanged(this.areFieldsValid());
          };
          FieldStatus2.prototype.onElementValidating = function(e) {
            this.statuses.set(e.field, "Validating");
            this.handleStatusChanged(false);
          };
          FieldStatus2.prototype.onElementValidated = function(e) {
            this.statuses.set(e.field, e.valid ? "Valid" : "Invalid");
            if (e.valid) {
              this.handleStatusChanged(this.areFieldsValid());
            } else {
              this.handleStatusChanged(false);
            }
          };
          FieldStatus2.prototype.onElementNotValidated = function(e) {
            this.statuses.set(e.field, "NotValidated");
            this.handleStatusChanged(false);
          };
          FieldStatus2.prototype.onElementIgnored = function(e) {
            this.statuses.set(e.field, "Ignored");
            this.handleStatusChanged(this.areFieldsValid());
          };
          FieldStatus2.prototype.handleStatusChanged = function(areFieldsValid) {
            if (this.isEnabled) {
              this.opts.onStatusChanged(areFieldsValid);
            }
          };
          return FieldStatus2;
        }(core.Plugin)
      );
      cjs$u.FieldStatus = FieldStatus;
      return cjs$u;
    }
    if (false) {
      lib$u.exports = requireIndex_min$u();
    } else {
      lib$u.exports = requireCjs$u();
    }
    var libExports$u = lib$u.exports;
    var lib$t = { exports: {} };
    var lib$s = { exports: {} };
    var cjs$t = {};
    var hasRequiredCjs$t;
    function requireCjs$t() {
      if (hasRequiredCjs$t)
        return cjs$t;
      hasRequiredCjs$t = 1;
      var core = libExports$B;
      var extendStatics = function(d, b) {
        extendStatics = Object.setPrototypeOf || { __proto__: [] } instanceof Array && function(d2, b2) {
          d2.__proto__ = b2;
        } || function(d2, b2) {
          for (var p in b2)
            if (Object.prototype.hasOwnProperty.call(b2, p))
              d2[p] = b2[p];
        };
        return extendStatics(d, b);
      };
      function __extends(d, b) {
        if (typeof b !== "function" && b !== null)
          throw new TypeError("Class extends value " + String(b) + " is not a constructor or null");
        extendStatics(d, b);
        function __() {
          this.constructor = d;
        }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
      }
      var classSet = core.utils.classSet;
      var Message = (
        /** @class */
        function(_super) {
          __extends(Message2, _super);
          function Message2(opts) {
            var _this = _super.call(this, opts) || this;
            _this.useDefaultContainer = false;
            _this.messages = /* @__PURE__ */ new Map();
            _this.defaultContainer = document.createElement("div");
            _this.useDefaultContainer = !opts || !opts.container;
            _this.opts = Object.assign({}, {
              container: function(_field, _element) {
                return _this.defaultContainer;
              }
            }, opts);
            _this.elementIgnoredHandler = _this.onElementIgnored.bind(_this);
            _this.fieldAddedHandler = _this.onFieldAdded.bind(_this);
            _this.fieldRemovedHandler = _this.onFieldRemoved.bind(_this);
            _this.validatorValidatedHandler = _this.onValidatorValidated.bind(_this);
            _this.validatorNotValidatedHandler = _this.onValidatorNotValidated.bind(_this);
            return _this;
          }
          Message2.getClosestContainer = function(element, upper, pattern) {
            var ele = element;
            while (ele) {
              if (ele === upper) {
                break;
              }
              ele = ele.parentElement;
              if (pattern.test(ele.className)) {
                break;
              }
            }
            return ele;
          };
          Message2.prototype.install = function() {
            if (this.useDefaultContainer) {
              this.core.getFormElement().appendChild(this.defaultContainer);
            }
            this.core.on("core.element.ignored", this.elementIgnoredHandler).on("core.field.added", this.fieldAddedHandler).on("core.field.removed", this.fieldRemovedHandler).on("core.validator.validated", this.validatorValidatedHandler).on("core.validator.notvalidated", this.validatorNotValidatedHandler);
          };
          Message2.prototype.uninstall = function() {
            if (this.useDefaultContainer) {
              this.core.getFormElement().removeChild(this.defaultContainer);
            }
            this.messages.forEach(function(message) {
              return message.parentNode.removeChild(message);
            });
            this.messages.clear();
            this.core.off("core.element.ignored", this.elementIgnoredHandler).off("core.field.added", this.fieldAddedHandler).off("core.field.removed", this.fieldRemovedHandler).off("core.validator.validated", this.validatorValidatedHandler).off("core.validator.notvalidated", this.validatorNotValidatedHandler);
          };
          Message2.prototype.onEnabled = function() {
            this.messages.forEach(function(_element, message, _map) {
              classSet(message, {
                "fv-plugins-message-container--enabled": true,
                "fv-plugins-message-container--disabled": false
              });
            });
          };
          Message2.prototype.onDisabled = function() {
            this.messages.forEach(function(_element, message, _map) {
              classSet(message, {
                "fv-plugins-message-container--enabled": false,
                "fv-plugins-message-container--disabled": true
              });
            });
          };
          Message2.prototype.onFieldAdded = function(e) {
            var _this = this;
            var elements = e.elements;
            if (elements) {
              elements.forEach(function(ele) {
                var msg = _this.messages.get(ele);
                if (msg) {
                  msg.parentNode.removeChild(msg);
                  _this.messages.delete(ele);
                }
              });
              this.prepareFieldContainer(e.field, elements);
            }
          };
          Message2.prototype.onFieldRemoved = function(e) {
            var _this = this;
            if (!e.elements.length || !e.field) {
              return;
            }
            var type = e.elements[0].getAttribute("type");
            var elements = "radio" === type || "checkbox" === type ? [e.elements[0]] : e.elements;
            elements.forEach(function(ele) {
              if (_this.messages.has(ele)) {
                var container = _this.messages.get(ele);
                container.parentNode.removeChild(container);
                _this.messages.delete(ele);
              }
            });
          };
          Message2.prototype.prepareFieldContainer = function(field, elements) {
            var _this = this;
            if (elements.length) {
              var type = elements[0].getAttribute("type");
              if ("radio" === type || "checkbox" === type) {
                this.prepareElementContainer(field, elements[0], elements);
              } else {
                elements.forEach(function(ele) {
                  return _this.prepareElementContainer(field, ele, elements);
                });
              }
            }
          };
          Message2.prototype.prepareElementContainer = function(field, element, elements) {
            var container;
            if ("string" === typeof this.opts.container) {
              var selector = "#" === this.opts.container.charAt(0) ? '[id="'.concat(this.opts.container.substring(1), '"]') : this.opts.container;
              container = this.core.getFormElement().querySelector(selector);
            } else {
              container = this.opts.container(field, element);
            }
            var message = document.createElement("div");
            container.appendChild(message);
            classSet(message, {
              "fv-plugins-message-container": true,
              "fv-plugins-message-container--enabled": this.isEnabled,
              "fv-plugins-message-container--disabled": !this.isEnabled
            });
            this.core.emit("plugins.message.placed", {
              element,
              elements,
              field,
              messageElement: message
            });
            this.messages.set(element, message);
          };
          Message2.prototype.getMessage = function(result) {
            return typeof result.message === "string" ? result.message : result.message[this.core.getLocale()];
          };
          Message2.prototype.onValidatorValidated = function(e) {
            var _a;
            var elements = e.elements;
            var type = e.element.getAttribute("type");
            var element = ("radio" === type || "checkbox" === type) && elements.length > 0 ? elements[0] : e.element;
            if (this.messages.has(element)) {
              var container = this.messages.get(element);
              var messageEle = container.querySelector('[data-field="'.concat(e.field.replace(/"/g, '\\"'), '"][data-validator="').concat(e.validator.replace(/"/g, '\\"'), '"]'));
              if (!messageEle && !e.result.valid) {
                var ele = document.createElement("div");
                ele.innerHTML = this.getMessage(e.result);
                ele.setAttribute("data-field", e.field);
                ele.setAttribute("data-validator", e.validator);
                if (this.opts.clazz) {
                  classSet(ele, (_a = {}, _a[this.opts.clazz] = true, _a));
                }
                container.appendChild(ele);
                this.core.emit("plugins.message.displayed", {
                  element: e.element,
                  field: e.field,
                  message: e.result.message,
                  messageElement: ele,
                  meta: e.result.meta,
                  validator: e.validator
                });
              } else if (messageEle && !e.result.valid) {
                messageEle.innerHTML = this.getMessage(e.result);
                this.core.emit("plugins.message.displayed", {
                  element: e.element,
                  field: e.field,
                  message: e.result.message,
                  messageElement: messageEle,
                  meta: e.result.meta,
                  validator: e.validator
                });
              } else if (messageEle && e.result.valid) {
                container.removeChild(messageEle);
              }
            }
          };
          Message2.prototype.onValidatorNotValidated = function(e) {
            var elements = e.elements;
            var type = e.element.getAttribute("type");
            var element = "radio" === type || "checkbox" === type ? elements[0] : e.element;
            if (this.messages.has(element)) {
              var container = this.messages.get(element);
              var messageEle = container.querySelector('[data-field="'.concat(e.field.replace(/"/g, '\\"'), '"][data-validator="').concat(e.validator.replace(/"/g, '\\"'), '"]'));
              if (messageEle) {
                container.removeChild(messageEle);
              }
            }
          };
          Message2.prototype.onElementIgnored = function(e) {
            var elements = e.elements;
            var type = e.element.getAttribute("type");
            var element = "radio" === type || "checkbox" === type ? elements[0] : e.element;
            if (this.messages.has(element)) {
              var container_1 = this.messages.get(element);
              var messageElements = [].slice.call(container_1.querySelectorAll('[data-field="'.concat(e.field.replace(/"/g, '\\"'), '"]')));
              messageElements.forEach(function(messageEle) {
                container_1.removeChild(messageEle);
              });
            }
          };
          return Message2;
        }(core.Plugin)
      );
      cjs$t.Message = Message;
      return cjs$t;
    }
    if (false) {
      lib$s.exports = requireIndex_min$t();
    } else {
      lib$s.exports = requireCjs$t();
    }
    var libExports$t = lib$s.exports;
    var cjs$s = {};
    var hasRequiredCjs$s;
    function requireCjs$s() {
      if (hasRequiredCjs$s)
        return cjs$s;
      hasRequiredCjs$s = 1;
      var core = libExports$B;
      var pluginMessage = libExports$t;
      var extendStatics = function(d, b) {
        extendStatics = Object.setPrototypeOf || { __proto__: [] } instanceof Array && function(d2, b2) {
          d2.__proto__ = b2;
        } || function(d2, b2) {
          for (var p in b2)
            if (Object.prototype.hasOwnProperty.call(b2, p))
              d2[p] = b2[p];
        };
        return extendStatics(d, b);
      };
      function __extends(d, b) {
        if (typeof b !== "function" && b !== null)
          throw new TypeError("Class extends value " + String(b) + " is not a constructor or null");
        extendStatics(d, b);
        function __() {
          this.constructor = d;
        }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
      }
      var classSet = core.utils.classSet, closest = core.utils.closest;
      var Framework = (
        /** @class */
        function(_super) {
          __extends(Framework2, _super);
          function Framework2(opts) {
            var _this = _super.call(this, opts) || this;
            _this.results = /* @__PURE__ */ new Map();
            _this.containers = /* @__PURE__ */ new Map();
            _this.opts = Object.assign({}, {
              defaultMessageContainer: true,
              eleInvalidClass: "",
              eleValidClass: "",
              rowClasses: "",
              rowValidatingClass: ""
            }, opts);
            _this.elementIgnoredHandler = _this.onElementIgnored.bind(_this);
            _this.elementValidatingHandler = _this.onElementValidating.bind(_this);
            _this.elementValidatedHandler = _this.onElementValidated.bind(_this);
            _this.elementNotValidatedHandler = _this.onElementNotValidated.bind(_this);
            _this.iconPlacedHandler = _this.onIconPlaced.bind(_this);
            _this.fieldAddedHandler = _this.onFieldAdded.bind(_this);
            _this.fieldRemovedHandler = _this.onFieldRemoved.bind(_this);
            _this.messagePlacedHandler = _this.onMessagePlaced.bind(_this);
            return _this;
          }
          Framework2.prototype.install = function() {
            var _a;
            var _this = this;
            classSet(this.core.getFormElement(), (_a = {}, _a[this.opts.formClass] = true, _a["fv-plugins-framework"] = true, _a));
            this.core.on("core.element.ignored", this.elementIgnoredHandler).on("core.element.validating", this.elementValidatingHandler).on("core.element.validated", this.elementValidatedHandler).on("core.element.notvalidated", this.elementNotValidatedHandler).on("plugins.icon.placed", this.iconPlacedHandler).on("core.field.added", this.fieldAddedHandler).on("core.field.removed", this.fieldRemovedHandler);
            if (this.opts.defaultMessageContainer) {
              this.core.registerPlugin(Framework2.MESSAGE_PLUGIN, new pluginMessage.Message({
                clazz: this.opts.messageClass,
                container: function(field, element) {
                  var selector = "string" === typeof _this.opts.rowSelector ? _this.opts.rowSelector : _this.opts.rowSelector(field, element);
                  var groupEle = closest(element, selector);
                  return pluginMessage.Message.getClosestContainer(element, groupEle, _this.opts.rowPattern);
                }
              }));
              this.core.on("plugins.message.placed", this.messagePlacedHandler);
            }
          };
          Framework2.prototype.uninstall = function() {
            var _a;
            this.results.clear();
            this.containers.clear();
            classSet(this.core.getFormElement(), (_a = {}, _a[this.opts.formClass] = false, _a["fv-plugins-framework"] = false, _a));
            this.core.off("core.element.ignored", this.elementIgnoredHandler).off("core.element.validating", this.elementValidatingHandler).off("core.element.validated", this.elementValidatedHandler).off("core.element.notvalidated", this.elementNotValidatedHandler).off("plugins.icon.placed", this.iconPlacedHandler).off("core.field.added", this.fieldAddedHandler).off("core.field.removed", this.fieldRemovedHandler);
            if (this.opts.defaultMessageContainer) {
              this.core.deregisterPlugin(Framework2.MESSAGE_PLUGIN);
              this.core.off("plugins.message.placed", this.messagePlacedHandler);
            }
          };
          Framework2.prototype.onEnabled = function() {
            var _a;
            classSet(this.core.getFormElement(), (_a = {}, _a[this.opts.formClass] = true, _a));
            if (this.opts.defaultMessageContainer) {
              this.core.enablePlugin(Framework2.MESSAGE_PLUGIN);
            }
          };
          Framework2.prototype.onDisabled = function() {
            var _a;
            classSet(this.core.getFormElement(), (_a = {}, _a[this.opts.formClass] = false, _a));
            if (this.opts.defaultMessageContainer) {
              this.core.disablePlugin(Framework2.MESSAGE_PLUGIN);
            }
          };
          Framework2.prototype.onIconPlaced = function(_e) {
          };
          Framework2.prototype.onMessagePlaced = function(_e) {
          };
          Framework2.prototype.onFieldAdded = function(e) {
            var _this = this;
            var elements = e.elements;
            if (elements) {
              elements.forEach(function(ele) {
                var _a;
                var groupEle = _this.containers.get(ele);
                if (groupEle) {
                  classSet(groupEle, (_a = {}, _a[_this.opts.rowInvalidClass] = false, _a[_this.opts.rowValidatingClass] = false, _a[_this.opts.rowValidClass] = false, _a["fv-plugins-icon-container"] = false, _a));
                  _this.containers.delete(ele);
                }
              });
              this.prepareFieldContainer(e.field, elements);
            }
          };
          Framework2.prototype.onFieldRemoved = function(e) {
            var _this = this;
            e.elements.forEach(function(ele) {
              var _a;
              var groupEle = _this.containers.get(ele);
              if (groupEle) {
                classSet(groupEle, (_a = {}, _a[_this.opts.rowInvalidClass] = false, _a[_this.opts.rowValidatingClass] = false, _a[_this.opts.rowValidClass] = false, _a));
              }
            });
          };
          Framework2.prototype.prepareFieldContainer = function(field, elements) {
            var _this = this;
            if (elements.length) {
              var type = elements[0].getAttribute("type");
              if ("radio" === type || "checkbox" === type) {
                this.prepareElementContainer(field, elements[0]);
              } else {
                elements.forEach(function(ele) {
                  return _this.prepareElementContainer(field, ele);
                });
              }
            }
          };
          Framework2.prototype.prepareElementContainer = function(field, element) {
            var _a;
            var selector = "string" === typeof this.opts.rowSelector ? this.opts.rowSelector : this.opts.rowSelector(field, element);
            var groupEle = closest(element, selector);
            if (groupEle !== element) {
              classSet(groupEle, (_a = {}, _a[this.opts.rowClasses] = true, _a["fv-plugins-icon-container"] = true, _a));
              this.containers.set(element, groupEle);
            }
          };
          Framework2.prototype.onElementValidating = function(e) {
            this.removeClasses(e.element, e.elements);
          };
          Framework2.prototype.onElementNotValidated = function(e) {
            this.removeClasses(e.element, e.elements);
          };
          Framework2.prototype.onElementIgnored = function(e) {
            this.removeClasses(e.element, e.elements);
          };
          Framework2.prototype.removeClasses = function(element, elements) {
            var _a;
            var _this = this;
            var type = element.getAttribute("type");
            var ele = "radio" === type || "checkbox" === type ? elements[0] : element;
            elements.forEach(function(ele2) {
              var _a2;
              classSet(ele2, (_a2 = {}, _a2[_this.opts.eleValidClass] = false, _a2[_this.opts.eleInvalidClass] = false, _a2));
            });
            var groupEle = this.containers.get(ele);
            if (groupEle) {
              classSet(groupEle, (_a = {}, _a[this.opts.rowInvalidClass] = false, _a[this.opts.rowValidatingClass] = false, _a[this.opts.rowValidClass] = false, _a));
            }
          };
          Framework2.prototype.onElementValidated = function(e) {
            var _a, _b;
            var _this = this;
            var elements = e.elements;
            var type = e.element.getAttribute("type");
            var element = "radio" === type || "checkbox" === type ? elements[0] : e.element;
            elements.forEach(function(ele) {
              var _a2;
              classSet(ele, (_a2 = {}, _a2[_this.opts.eleValidClass] = e.valid, _a2[_this.opts.eleInvalidClass] = !e.valid, _a2));
            });
            var groupEle = this.containers.get(element);
            if (groupEle) {
              if (!e.valid) {
                this.results.set(element, false);
                classSet(groupEle, (_a = {}, _a[this.opts.rowInvalidClass] = true, _a[this.opts.rowValidatingClass] = false, _a[this.opts.rowValidClass] = false, _a));
              } else {
                this.results.delete(element);
                var isValid_1 = true;
                this.containers.forEach(function(value, key) {
                  if (value === groupEle && _this.results.get(key) === false) {
                    isValid_1 = false;
                  }
                });
                if (isValid_1) {
                  classSet(groupEle, (_b = {}, _b[this.opts.rowInvalidClass] = false, _b[this.opts.rowValidatingClass] = false, _b[this.opts.rowValidClass] = true, _b));
                }
              }
            }
          };
          Framework2.MESSAGE_PLUGIN = "___frameworkMessage";
          return Framework2;
        }(core.Plugin)
      );
      cjs$s.Framework = Framework;
      return cjs$s;
    }
    if (false) {
      lib$t.exports = requireIndex_min$s();
    } else {
      lib$t.exports = requireCjs$s();
    }
    var libExports$s = lib$t.exports;
    var lib$r = { exports: {} };
    var cjs$r = {};
    var hasRequiredCjs$r;
    function requireCjs$r() {
      if (hasRequiredCjs$r)
        return cjs$r;
      hasRequiredCjs$r = 1;
      var core = libExports$B;
      var extendStatics = function(d, b) {
        extendStatics = Object.setPrototypeOf || { __proto__: [] } instanceof Array && function(d2, b2) {
          d2.__proto__ = b2;
        } || function(d2, b2) {
          for (var p in b2)
            if (Object.prototype.hasOwnProperty.call(b2, p))
              d2[p] = b2[p];
        };
        return extendStatics(d, b);
      };
      function __extends(d, b) {
        if (typeof b !== "function" && b !== null)
          throw new TypeError("Class extends value " + String(b) + " is not a constructor or null");
        extendStatics(d, b);
        function __() {
          this.constructor = d;
        }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
      }
      var classSet = core.utils.classSet;
      var Icon = (
        /** @class */
        function(_super) {
          __extends(Icon2, _super);
          function Icon2(opts) {
            var _this = _super.call(this, opts) || this;
            _this.icons = /* @__PURE__ */ new Map();
            _this.opts = Object.assign({}, {
              invalid: "fv-plugins-icon--invalid",
              onPlaced: function() {
              },
              onSet: function() {
              },
              valid: "fv-plugins-icon--valid",
              validating: "fv-plugins-icon--validating"
            }, opts);
            _this.elementValidatingHandler = _this.onElementValidating.bind(_this);
            _this.elementValidatedHandler = _this.onElementValidated.bind(_this);
            _this.elementNotValidatedHandler = _this.onElementNotValidated.bind(_this);
            _this.elementIgnoredHandler = _this.onElementIgnored.bind(_this);
            _this.fieldAddedHandler = _this.onFieldAdded.bind(_this);
            return _this;
          }
          Icon2.prototype.install = function() {
            this.core.on("core.element.validating", this.elementValidatingHandler).on("core.element.validated", this.elementValidatedHandler).on("core.element.notvalidated", this.elementNotValidatedHandler).on("core.element.ignored", this.elementIgnoredHandler).on("core.field.added", this.fieldAddedHandler);
          };
          Icon2.prototype.uninstall = function() {
            this.icons.forEach(function(icon) {
              return icon.parentNode.removeChild(icon);
            });
            this.icons.clear();
            this.core.off("core.element.validating", this.elementValidatingHandler).off("core.element.validated", this.elementValidatedHandler).off("core.element.notvalidated", this.elementNotValidatedHandler).off("core.element.ignored", this.elementIgnoredHandler).off("core.field.added", this.fieldAddedHandler);
          };
          Icon2.prototype.onEnabled = function() {
            this.icons.forEach(function(_element, i, _map) {
              classSet(i, {
                "fv-plugins-icon--enabled": true,
                "fv-plugins-icon--disabled": false
              });
            });
          };
          Icon2.prototype.onDisabled = function() {
            this.icons.forEach(function(_element, i, _map) {
              classSet(i, {
                "fv-plugins-icon--enabled": false,
                "fv-plugins-icon--disabled": true
              });
            });
          };
          Icon2.prototype.onFieldAdded = function(e) {
            var _this = this;
            var elements = e.elements;
            if (elements) {
              elements.forEach(function(ele) {
                var icon = _this.icons.get(ele);
                if (icon) {
                  icon.parentNode.removeChild(icon);
                  _this.icons.delete(ele);
                }
              });
              this.prepareFieldIcon(e.field, elements);
            }
          };
          Icon2.prototype.prepareFieldIcon = function(field, elements) {
            var _this = this;
            if (elements.length) {
              var type = elements[0].getAttribute("type");
              if ("radio" === type || "checkbox" === type) {
                this.prepareElementIcon(field, elements[0]);
              } else {
                elements.forEach(function(ele) {
                  return _this.prepareElementIcon(field, ele);
                });
              }
            }
          };
          Icon2.prototype.prepareElementIcon = function(field, ele) {
            var i = document.createElement("i");
            i.setAttribute("data-field", field);
            ele.parentNode.insertBefore(i, ele.nextSibling);
            classSet(i, {
              "fv-plugins-icon": true,
              "fv-plugins-icon--enabled": this.isEnabled,
              "fv-plugins-icon--disabled": !this.isEnabled
            });
            var e = {
              classes: {
                invalid: this.opts.invalid,
                valid: this.opts.valid,
                validating: this.opts.validating
              },
              element: ele,
              field,
              iconElement: i
            };
            this.core.emit("plugins.icon.placed", e);
            this.opts.onPlaced(e);
            this.icons.set(ele, i);
          };
          Icon2.prototype.onElementValidating = function(e) {
            var _a;
            var icon = this.setClasses(e.field, e.element, e.elements, (_a = {}, _a[this.opts.invalid] = false, _a[this.opts.valid] = false, _a[this.opts.validating] = true, _a));
            var evt = {
              element: e.element,
              field: e.field,
              iconElement: icon,
              status: "Validating"
            };
            this.core.emit("plugins.icon.set", evt);
            this.opts.onSet(evt);
          };
          Icon2.prototype.onElementValidated = function(e) {
            var _a;
            var icon = this.setClasses(e.field, e.element, e.elements, (_a = {}, _a[this.opts.invalid] = !e.valid, _a[this.opts.valid] = e.valid, _a[this.opts.validating] = false, _a));
            var evt = {
              element: e.element,
              field: e.field,
              iconElement: icon,
              status: e.valid ? "Valid" : "Invalid"
            };
            this.core.emit("plugins.icon.set", evt);
            this.opts.onSet(evt);
          };
          Icon2.prototype.onElementNotValidated = function(e) {
            var _a;
            var icon = this.setClasses(e.field, e.element, e.elements, (_a = {}, _a[this.opts.invalid] = false, _a[this.opts.valid] = false, _a[this.opts.validating] = false, _a));
            var evt = {
              element: e.element,
              field: e.field,
              iconElement: icon,
              status: "NotValidated"
            };
            this.core.emit("plugins.icon.set", evt);
            this.opts.onSet(evt);
          };
          Icon2.prototype.onElementIgnored = function(e) {
            var _a;
            var icon = this.setClasses(e.field, e.element, e.elements, (_a = {}, _a[this.opts.invalid] = false, _a[this.opts.valid] = false, _a[this.opts.validating] = false, _a));
            var evt = {
              element: e.element,
              field: e.field,
              iconElement: icon,
              status: "Ignored"
            };
            this.core.emit("plugins.icon.set", evt);
            this.opts.onSet(evt);
          };
          Icon2.prototype.setClasses = function(_field, element, elements, classes) {
            var type = element.getAttribute("type");
            var ele = "radio" === type || "checkbox" === type ? elements[0] : element;
            if (this.icons.has(ele)) {
              var icon = this.icons.get(ele);
              classSet(icon, classes);
              return icon;
            } else {
              return null;
            }
          };
          return Icon2;
        }(core.Plugin)
      );
      cjs$r.Icon = Icon;
      return cjs$r;
    }
    if (false) {
      lib$r.exports = requireIndex_min$r();
    } else {
      lib$r.exports = requireCjs$r();
    }
    var libExports$r = lib$r.exports;
    var lib$q = { exports: {} };
    var cjs$q = {};
    var hasRequiredCjs$q;
    function requireCjs$q() {
      if (hasRequiredCjs$q)
        return cjs$q;
      hasRequiredCjs$q = 1;
      var core = libExports$B;
      var extendStatics = function(d, b) {
        extendStatics = Object.setPrototypeOf || { __proto__: [] } instanceof Array && function(d2, b2) {
          d2.__proto__ = b2;
        } || function(d2, b2) {
          for (var p in b2)
            if (Object.prototype.hasOwnProperty.call(b2, p))
              d2[p] = b2[p];
        };
        return extendStatics(d, b);
      };
      function __extends(d, b) {
        if (typeof b !== "function" && b !== null)
          throw new TypeError("Class extends value " + String(b) + " is not a constructor or null");
        extendStatics(d, b);
        function __() {
          this.constructor = d;
        }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
      }
      var removeUndefined = core.utils.removeUndefined;
      var Sequence = (
        /** @class */
        function(_super) {
          __extends(Sequence2, _super);
          function Sequence2(opts) {
            var _this = _super.call(this, opts) || this;
            _this.invalidFields = /* @__PURE__ */ new Map();
            _this.opts = Object.assign({}, { enabled: true }, removeUndefined(opts));
            _this.validatorHandler = _this.onValidatorValidated.bind(_this);
            _this.shouldValidateFilter = _this.shouldValidate.bind(_this);
            _this.fieldAddedHandler = _this.onFieldAdded.bind(_this);
            _this.elementNotValidatedHandler = _this.onElementNotValidated.bind(_this);
            _this.elementValidatingHandler = _this.onElementValidating.bind(_this);
            return _this;
          }
          Sequence2.prototype.install = function() {
            this.core.on("core.validator.validated", this.validatorHandler).on("core.field.added", this.fieldAddedHandler).on("core.element.notvalidated", this.elementNotValidatedHandler).on("core.element.validating", this.elementValidatingHandler).registerFilter("field-should-validate", this.shouldValidateFilter);
          };
          Sequence2.prototype.uninstall = function() {
            this.invalidFields.clear();
            this.core.off("core.validator.validated", this.validatorHandler).off("core.field.added", this.fieldAddedHandler).off("core.element.notvalidated", this.elementNotValidatedHandler).off("core.element.validating", this.elementValidatingHandler).deregisterFilter("field-should-validate", this.shouldValidateFilter);
          };
          Sequence2.prototype.shouldValidate = function(field, element, _value, validator) {
            if (!this.isEnabled) {
              return true;
            }
            var stop = (this.opts.enabled === true || this.opts.enabled[field] === true) && this.invalidFields.has(element) && !!this.invalidFields.get(element).length && this.invalidFields.get(element).indexOf(validator) === -1;
            return !stop;
          };
          Sequence2.prototype.onValidatorValidated = function(e) {
            var validators2 = this.invalidFields.has(e.element) ? this.invalidFields.get(e.element) : [];
            var index = validators2.indexOf(e.validator);
            if (e.result.valid && index >= 0) {
              validators2.splice(index, 1);
            } else if (!e.result.valid && index === -1) {
              validators2.push(e.validator);
            }
            this.invalidFields.set(e.element, validators2);
          };
          Sequence2.prototype.onFieldAdded = function(e) {
            if (e.elements) {
              this.clearInvalidFields(e.elements);
            }
          };
          Sequence2.prototype.onElementNotValidated = function(e) {
            this.clearInvalidFields(e.elements);
          };
          Sequence2.prototype.onElementValidating = function(e) {
            this.clearInvalidFields(e.elements);
          };
          Sequence2.prototype.clearInvalidFields = function(elements) {
            var _this = this;
            elements.forEach(function(ele) {
              return _this.invalidFields.delete(ele);
            });
          };
          return Sequence2;
        }(core.Plugin)
      );
      cjs$q.Sequence = Sequence;
      return cjs$q;
    }
    if (false) {
      lib$q.exports = requireIndex_min$q();
    } else {
      lib$q.exports = requireCjs$q();
    }
    var libExports$q = lib$q.exports;
    var lib$p = { exports: {} };
    var cjs$p = {};
    var hasRequiredCjs$p;
    function requireCjs$p() {
      if (hasRequiredCjs$p)
        return cjs$p;
      hasRequiredCjs$p = 1;
      var core = libExports$B;
      var extendStatics = function(d, b) {
        extendStatics = Object.setPrototypeOf || { __proto__: [] } instanceof Array && function(d2, b2) {
          d2.__proto__ = b2;
        } || function(d2, b2) {
          for (var p in b2)
            if (Object.prototype.hasOwnProperty.call(b2, p))
              d2[p] = b2[p];
        };
        return extendStatics(d, b);
      };
      function __extends(d, b) {
        if (typeof b !== "function" && b !== null)
          throw new TypeError("Class extends value " + String(b) + " is not a constructor or null");
        extendStatics(d, b);
        function __() {
          this.constructor = d;
        }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
      }
      var SubmitButton = (
        /** @class */
        function(_super) {
          __extends(SubmitButton2, _super);
          function SubmitButton2(opts) {
            var _this = _super.call(this, opts) || this;
            _this.isFormValid = false;
            _this.isButtonClicked = false;
            _this.opts = Object.assign({}, {
              // Set it to `true` to support classical ASP.Net form
              aspNetButton: false,
              // By default, don't perform validation when clicking on
              // the submit button/input which have `formnovalidate` attribute
              buttons: function(form) {
                return [].slice.call(form.querySelectorAll('[type="submit"]:not([formnovalidate])'));
              },
              liveMode: true
            }, opts);
            _this.submitHandler = _this.handleSubmitEvent.bind(_this);
            _this.buttonClickHandler = _this.handleClickEvent.bind(_this);
            _this.ignoreValidationFilter = _this.ignoreValidation.bind(_this);
            return _this;
          }
          SubmitButton2.prototype.install = function() {
            var _this = this;
            if (!(this.core.getFormElement() instanceof HTMLFormElement)) {
              return;
            }
            var form = this.core.getFormElement();
            this.submitButtons = this.opts.buttons(form);
            form.setAttribute("novalidate", "novalidate");
            form.addEventListener("submit", this.submitHandler);
            this.hiddenClickedEle = document.createElement("input");
            this.hiddenClickedEle.setAttribute("type", "hidden");
            form.appendChild(this.hiddenClickedEle);
            this.submitButtons.forEach(function(button) {
              button.addEventListener("click", _this.buttonClickHandler);
            });
            this.core.registerFilter("element-ignored", this.ignoreValidationFilter);
          };
          SubmitButton2.prototype.uninstall = function() {
            var _this = this;
            var form = this.core.getFormElement();
            if (form instanceof HTMLFormElement) {
              form.removeEventListener("submit", this.submitHandler);
            }
            this.submitButtons.forEach(function(button) {
              button.removeEventListener("click", _this.buttonClickHandler);
            });
            this.hiddenClickedEle.parentElement.removeChild(this.hiddenClickedEle);
            this.core.deregisterFilter("element-ignored", this.ignoreValidationFilter);
          };
          SubmitButton2.prototype.handleSubmitEvent = function(e) {
            this.validateForm(e);
          };
          SubmitButton2.prototype.handleClickEvent = function(e) {
            var target = e.currentTarget;
            this.isButtonClicked = true;
            if (target instanceof HTMLElement) {
              if (this.opts.aspNetButton && this.isFormValid === true)
                ;
              else {
                var form = this.core.getFormElement();
                form.removeEventListener("submit", this.submitHandler);
                this.clickedButton = e.target;
                var name_1 = this.clickedButton.getAttribute("name");
                var value = this.clickedButton.getAttribute("value");
                if (name_1 && value) {
                  this.hiddenClickedEle.setAttribute("name", name_1);
                  this.hiddenClickedEle.setAttribute("value", value);
                }
                this.validateForm(e);
              }
            }
          };
          SubmitButton2.prototype.validateForm = function(e) {
            var _this = this;
            if (!this.isEnabled) {
              return;
            }
            e.preventDefault();
            this.core.validate().then(function(result) {
              if (result === "Valid" && _this.opts.aspNetButton && !_this.isFormValid && _this.clickedButton) {
                _this.isFormValid = true;
                _this.clickedButton.removeEventListener("click", _this.buttonClickHandler);
                _this.clickedButton.click();
              }
            });
          };
          SubmitButton2.prototype.ignoreValidation = function(_field, _element, _elements) {
            if (!this.isEnabled) {
              return false;
            }
            return this.opts.liveMode ? false : !this.isButtonClicked;
          };
          return SubmitButton2;
        }(core.Plugin)
      );
      cjs$p.SubmitButton = SubmitButton;
      return cjs$p;
    }
    if (false) {
      lib$p.exports = requireIndex_min$p();
    } else {
      lib$p.exports = requireCjs$p();
    }
    var libExports$p = lib$p.exports;
    var lib$o = { exports: {} };
    var cjs$o = {};
    var hasRequiredCjs$o;
    function requireCjs$o() {
      if (hasRequiredCjs$o)
        return cjs$o;
      hasRequiredCjs$o = 1;
      var core = libExports$B;
      var extendStatics = function(d, b) {
        extendStatics = Object.setPrototypeOf || { __proto__: [] } instanceof Array && function(d2, b2) {
          d2.__proto__ = b2;
        } || function(d2, b2) {
          for (var p in b2)
            if (Object.prototype.hasOwnProperty.call(b2, p))
              d2[p] = b2[p];
        };
        return extendStatics(d, b);
      };
      function __extends(d, b) {
        if (typeof b !== "function" && b !== null)
          throw new TypeError("Class extends value " + String(b) + " is not a constructor or null");
        extendStatics(d, b);
        function __() {
          this.constructor = d;
        }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
      }
      var classSet = core.utils.classSet;
      var Tooltip = (
        /** @class */
        function(_super) {
          __extends(Tooltip2, _super);
          function Tooltip2(opts) {
            var _this = _super.call(this, opts) || this;
            _this.messages = /* @__PURE__ */ new Map();
            _this.opts = Object.assign({}, {
              placement: "top",
              trigger: "click"
            }, opts);
            _this.iconPlacedHandler = _this.onIconPlaced.bind(_this);
            _this.validatorValidatedHandler = _this.onValidatorValidated.bind(_this);
            _this.elementValidatedHandler = _this.onElementValidated.bind(_this);
            _this.documentClickHandler = _this.onDocumentClicked.bind(_this);
            return _this;
          }
          Tooltip2.prototype.install = function() {
            var _a;
            this.tip = document.createElement("div");
            classSet(this.tip, (_a = {
              "fv-plugins-tooltip": true
            }, _a["fv-plugins-tooltip--".concat(this.opts.placement)] = true, _a));
            document.body.appendChild(this.tip);
            this.core.on("plugins.icon.placed", this.iconPlacedHandler).on("core.validator.validated", this.validatorValidatedHandler).on("core.element.validated", this.elementValidatedHandler);
            if ("click" === this.opts.trigger) {
              document.addEventListener("click", this.documentClickHandler);
            }
          };
          Tooltip2.prototype.uninstall = function() {
            this.messages.clear();
            document.body.removeChild(this.tip);
            this.core.off("plugins.icon.placed", this.iconPlacedHandler).off("core.validator.validated", this.validatorValidatedHandler).off("core.element.validated", this.elementValidatedHandler);
            if ("click" === this.opts.trigger) {
              document.removeEventListener("click", this.documentClickHandler);
            }
          };
          Tooltip2.prototype.onIconPlaced = function(e) {
            var _this = this;
            classSet(e.iconElement, {
              "fv-plugins-tooltip-icon": true
            });
            switch (this.opts.trigger) {
              case "hover":
                e.iconElement.addEventListener("mouseenter", function(evt) {
                  return _this.show(e.element, evt);
                });
                e.iconElement.addEventListener("mouseleave", function(_evt) {
                  return _this.hide();
                });
                break;
              case "click":
              default:
                e.iconElement.addEventListener("click", function(evt) {
                  return _this.show(e.element, evt);
                });
                break;
            }
          };
          Tooltip2.prototype.onValidatorValidated = function(e) {
            if (!e.result.valid) {
              var elements = e.elements;
              var type = e.element.getAttribute("type");
              var ele = "radio" === type || "checkbox" === type ? elements[0] : e.element;
              var message = typeof e.result.message === "string" ? e.result.message : e.result.message[this.core.getLocale()];
              this.messages.set(ele, message);
            }
          };
          Tooltip2.prototype.onElementValidated = function(e) {
            if (e.valid) {
              var elements = e.elements;
              var type = e.element.getAttribute("type");
              var ele = "radio" === type || "checkbox" === type ? elements[0] : e.element;
              this.messages.delete(ele);
            }
          };
          Tooltip2.prototype.onDocumentClicked = function(_e) {
            this.hide();
          };
          Tooltip2.prototype.show = function(ele, e) {
            if (!this.isEnabled) {
              return;
            }
            e.preventDefault();
            e.stopPropagation();
            if (!this.messages.has(ele)) {
              return;
            }
            classSet(this.tip, {
              "fv-plugins-tooltip--hide": false
            });
            this.tip.innerHTML = '<div class="fv-plugins-tooltip__content">'.concat(this.messages.get(ele), "</div>");
            var icon = e.target;
            var targetRect = icon.getBoundingClientRect();
            var _a = this.tip.getBoundingClientRect(), height = _a.height, width = _a.width;
            var top = 0;
            var left = 0;
            switch (this.opts.placement) {
              case "bottom":
                top = targetRect.top + targetRect.height;
                left = targetRect.left + targetRect.width / 2 - width / 2;
                break;
              case "bottom-left":
                top = targetRect.top + targetRect.height;
                left = targetRect.left;
                break;
              case "bottom-right":
                top = targetRect.top + targetRect.height;
                left = targetRect.left + targetRect.width - width;
                break;
              case "left":
                top = targetRect.top + targetRect.height / 2 - height / 2;
                left = targetRect.left - width;
                break;
              case "right":
                top = targetRect.top + targetRect.height / 2 - height / 2;
                left = targetRect.left + targetRect.width;
                break;
              case "top-left":
                top = targetRect.top - height;
                left = targetRect.left;
                break;
              case "top-right":
                top = targetRect.top - height;
                left = targetRect.left + targetRect.width - width;
                break;
              case "top":
              default:
                top = targetRect.top - height;
                left = targetRect.left + targetRect.width / 2 - width / 2;
                break;
            }
            var scrollTop = window.scrollY || document.documentElement.scrollTop || document.body.scrollTop || 0;
            var scrollLeft = window.scrollX || document.documentElement.scrollLeft || document.body.scrollLeft || 0;
            top = top + scrollTop;
            left = left + scrollLeft;
            this.tip.setAttribute("style", "top: ".concat(top, "px; left: ").concat(left, "px"));
          };
          Tooltip2.prototype.hide = function() {
            if (this.isEnabled) {
              classSet(this.tip, {
                "fv-plugins-tooltip--hide": true
              });
            }
          };
          return Tooltip2;
        }(core.Plugin)
      );
      cjs$o.Tooltip = Tooltip;
      return cjs$o;
    }
    if (false) {
      lib$o.exports = requireIndex_min$o();
    } else {
      lib$o.exports = requireCjs$o();
    }
    var libExports$o = lib$o.exports;
    var lib$n = { exports: {} };
    var cjs$n = {};
    var hasRequiredCjs$n;
    function requireCjs$n() {
      if (hasRequiredCjs$n)
        return cjs$n;
      hasRequiredCjs$n = 1;
      var core = libExports$B;
      var extendStatics = function(d, b) {
        extendStatics = Object.setPrototypeOf || { __proto__: [] } instanceof Array && function(d2, b2) {
          d2.__proto__ = b2;
        } || function(d2, b2) {
          for (var p in b2)
            if (Object.prototype.hasOwnProperty.call(b2, p))
              d2[p] = b2[p];
        };
        return extendStatics(d, b);
      };
      function __extends(d, b) {
        if (typeof b !== "function" && b !== null)
          throw new TypeError("Class extends value " + String(b) + " is not a constructor or null");
        extendStatics(d, b);
        function __() {
          this.constructor = d;
        }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
      }
      var Trigger = (
        /** @class */
        function(_super) {
          __extends(Trigger2, _super);
          function Trigger2(opts) {
            var _this = _super.call(this, opts) || this;
            _this.handlers = [];
            _this.timers = /* @__PURE__ */ new Map();
            var ele = document.createElement("div");
            _this.defaultEvent = !("oninput" in ele) ? "keyup" : "input";
            _this.opts = Object.assign({}, {
              delay: 0,
              event: _this.defaultEvent,
              threshold: 0
            }, opts);
            _this.fieldAddedHandler = _this.onFieldAdded.bind(_this);
            _this.fieldRemovedHandler = _this.onFieldRemoved.bind(_this);
            return _this;
          }
          Trigger2.prototype.install = function() {
            this.core.on("core.field.added", this.fieldAddedHandler).on("core.field.removed", this.fieldRemovedHandler);
          };
          Trigger2.prototype.uninstall = function() {
            this.handlers.forEach(function(item) {
              return item.element.removeEventListener(item.event, item.handler);
            });
            this.handlers = [];
            this.timers.forEach(function(t) {
              return window.clearTimeout(t);
            });
            this.timers.clear();
            this.core.off("core.field.added", this.fieldAddedHandler).off("core.field.removed", this.fieldRemovedHandler);
          };
          Trigger2.prototype.prepareHandler = function(field, elements) {
            var _this = this;
            elements.forEach(function(ele) {
              var events = [];
              if (!!_this.opts.event && _this.opts.event[field] === false) {
                events = [];
              } else if (!!_this.opts.event && !!_this.opts.event[field] && typeof _this.opts.event[field] !== "function") {
                events = _this.opts.event[field].split(" ");
              } else if ("string" === typeof _this.opts.event && _this.opts.event !== _this.defaultEvent) {
                events = _this.opts.event.split(" ");
              } else {
                var type = ele.getAttribute("type");
                var tagName = ele.tagName.toLowerCase();
                var event_1 = "radio" === type || "checkbox" === type || "file" === type || "select" === tagName ? "change" : _this.ieVersion >= 10 && ele.getAttribute("placeholder") ? "keyup" : _this.defaultEvent;
                events = [event_1];
              }
              events.forEach(function(evt) {
                var evtHandler = function(e) {
                  return _this.handleEvent(e, field, ele);
                };
                _this.handlers.push({
                  element: ele,
                  event: evt,
                  field,
                  handler: evtHandler
                });
                ele.addEventListener(evt, evtHandler);
              });
            });
          };
          Trigger2.prototype.handleEvent = function(e, field, ele) {
            var _this = this;
            if (this.isEnabled && this.exceedThreshold(field, ele) && this.core.executeFilter("plugins-trigger-should-validate", true, [field, ele])) {
              var handler = function() {
                return _this.core.validateElement(field, ele).then(function(_) {
                  _this.core.emit("plugins.trigger.executed", {
                    element: ele,
                    event: e,
                    field
                  });
                });
              };
              var delay = this.opts.delay[field] || this.opts.delay;
              if (delay === 0) {
                handler();
              } else {
                var timer = this.timers.get(ele);
                if (timer) {
                  window.clearTimeout(timer);
                }
                this.timers.set(ele, window.setTimeout(handler, delay * 1e3));
              }
            }
          };
          Trigger2.prototype.onFieldAdded = function(e) {
            this.handlers.filter(function(item) {
              return item.field === e.field;
            }).forEach(function(item) {
              return item.element.removeEventListener(item.event, item.handler);
            });
            this.prepareHandler(e.field, e.elements);
          };
          Trigger2.prototype.onFieldRemoved = function(e) {
            this.handlers.filter(function(item) {
              return item.field === e.field && e.elements.indexOf(item.element) >= 0;
            }).forEach(function(item) {
              return item.element.removeEventListener(item.event, item.handler);
            });
          };
          Trigger2.prototype.exceedThreshold = function(field, element) {
            var threshold = this.opts.threshold[field] === 0 || this.opts.threshold === 0 ? false : this.opts.threshold[field] || this.opts.threshold;
            if (!threshold) {
              return true;
            }
            var type = element.getAttribute("type");
            if (["button", "checkbox", "file", "hidden", "image", "radio", "reset", "submit"].indexOf(type) !== -1) {
              return true;
            }
            var value = this.core.getElementValue(field, element);
            return value.length >= threshold;
          };
          return Trigger2;
        }(core.Plugin)
      );
      cjs$n.Trigger = Trigger;
      return cjs$n;
    }
    if (false) {
      lib$n.exports = requireIndex_min$n();
    } else {
      lib$n.exports = requireCjs$n();
    }
    var libExports$n = lib$n.exports;
    var lib$m = { exports: {} };
    var cjs$m = {};
    var hasRequiredCjs$m;
    function requireCjs$m() {
      if (hasRequiredCjs$m)
        return cjs$m;
      hasRequiredCjs$m = 1;
      var core = libExports$B;
      var format = core.utils.format, removeUndefined = core.utils.removeUndefined;
      function between() {
        var formatValue = function(value) {
          return parseFloat("".concat(value).replace(",", "."));
        };
        return {
          validate: function(input) {
            var value = input.value;
            if (value === "") {
              return { valid: true };
            }
            var opts = Object.assign({}, { inclusive: true, message: "" }, removeUndefined(input.options));
            var minValue = formatValue(opts.min);
            var maxValue = formatValue(opts.max);
            return opts.inclusive ? {
              message: format(input.l10n ? opts.message || input.l10n.between.default : opts.message, [
                "".concat(minValue),
                "".concat(maxValue)
              ]),
              valid: parseFloat(value) >= minValue && parseFloat(value) <= maxValue
            } : {
              message: format(input.l10n ? opts.message || input.l10n.between.notInclusive : opts.message, [
                "".concat(minValue),
                "".concat(maxValue)
              ]),
              valid: parseFloat(value) > minValue && parseFloat(value) < maxValue
            };
          }
        };
      }
      cjs$m.between = between;
      return cjs$m;
    }
    if (false) {
      lib$m.exports = requireIndex_min$m();
    } else {
      lib$m.exports = requireCjs$m();
    }
    var libExports$m = lib$m.exports;
    var lib$l = { exports: {} };
    var cjs$l = {};
    var hasRequiredCjs$l;
    function requireCjs$l() {
      if (hasRequiredCjs$l)
        return cjs$l;
      hasRequiredCjs$l = 1;
      function blank() {
        return {
          validate: function(_input) {
            return { valid: true };
          }
        };
      }
      cjs$l.blank = blank;
      return cjs$l;
    }
    if (false) {
      lib$l.exports = requireIndex_min$l();
    } else {
      lib$l.exports = requireCjs$l();
    }
    var libExports$l = lib$l.exports;
    var lib$k = { exports: {} };
    var cjs$k = {};
    var hasRequiredCjs$k;
    function requireCjs$k() {
      if (hasRequiredCjs$k)
        return cjs$k;
      hasRequiredCjs$k = 1;
      var core = libExports$B;
      var call = core.utils.call;
      function callback() {
        return {
          validate: function(input) {
            var response = call(input.options.callback, [input]);
            return "boolean" === typeof response ? { valid: response } : response;
          }
        };
      }
      cjs$k.callback = callback;
      return cjs$k;
    }
    if (false) {
      lib$k.exports = requireIndex_min$k();
    } else {
      lib$k.exports = requireCjs$k();
    }
    var libExports$k = lib$k.exports;
    var lib$j = { exports: {} };
    var cjs$j = {};
    var hasRequiredCjs$j;
    function requireCjs$j() {
      if (hasRequiredCjs$j)
        return cjs$j;
      hasRequiredCjs$j = 1;
      var core = libExports$B;
      var format = core.utils.format;
      function choice() {
        return {
          validate: function(input) {
            var numChoices = "select" === input.element.tagName.toLowerCase() ? input.element.querySelectorAll("option:checked").length : input.elements.filter(function(ele) {
              return ele.checked;
            }).length;
            var min = input.options.min ? "".concat(input.options.min) : "";
            var max = input.options.max ? "".concat(input.options.max) : "";
            var msg = input.l10n ? input.options.message || input.l10n.choice.default : input.options.message;
            var isValid = !(min && numChoices < parseInt(min, 10) || max && numChoices > parseInt(max, 10));
            switch (true) {
              case (!!min && !!max):
                msg = format(input.l10n ? input.l10n.choice.between : input.options.message, [min, max]);
                break;
              case !!min:
                msg = format(input.l10n ? input.l10n.choice.more : input.options.message, min);
                break;
              case !!max:
                msg = format(input.l10n ? input.l10n.choice.less : input.options.message, max);
                break;
            }
            return {
              message: msg,
              valid: isValid
            };
          }
        };
      }
      cjs$j.choice = choice;
      return cjs$j;
    }
    if (false) {
      lib$j.exports = requireIndex_min$j();
    } else {
      lib$j.exports = requireCjs$j();
    }
    var libExports$j = lib$j.exports;
    var lib$i = { exports: {} };
    var cjs$i = {};
    var hasRequiredCjs$i;
    function requireCjs$i() {
      if (hasRequiredCjs$i)
        return cjs$i;
      hasRequiredCjs$i = 1;
      var core = libExports$B;
      var luhn = core.algorithms.luhn;
      var CREDIT_CARD_TYPES = {
        AMERICAN_EXPRESS: {
          length: [15],
          prefix: ["34", "37"]
        },
        DANKORT: {
          length: [16],
          prefix: ["5019"]
        },
        DINERS_CLUB: {
          length: [14],
          prefix: ["300", "301", "302", "303", "304", "305", "36"]
        },
        DINERS_CLUB_US: {
          length: [16],
          prefix: ["54", "55"]
        },
        DISCOVER: {
          length: [16],
          prefix: [
            "6011",
            "622126",
            "622127",
            "622128",
            "622129",
            "62213",
            "62214",
            "62215",
            "62216",
            "62217",
            "62218",
            "62219",
            "6222",
            "6223",
            "6224",
            "6225",
            "6226",
            "6227",
            "6228",
            "62290",
            "62291",
            "622920",
            "622921",
            "622922",
            "622923",
            "622924",
            "622925",
            "644",
            "645",
            "646",
            "647",
            "648",
            "649",
            "65"
          ]
        },
        ELO: {
          length: [16],
          prefix: [
            "4011",
            "4312",
            "4389",
            "4514",
            "4573",
            "4576",
            "5041",
            "5066",
            "5067",
            "509",
            "6277",
            "6362",
            "6363",
            "650",
            "6516",
            "6550"
          ]
        },
        FORBRUGSFORENINGEN: {
          length: [16],
          prefix: ["600722"]
        },
        JCB: {
          length: [16],
          prefix: ["3528", "3529", "353", "354", "355", "356", "357", "358"]
        },
        LASER: {
          length: [16, 17, 18, 19],
          prefix: ["6304", "6706", "6771", "6709"]
        },
        MAESTRO: {
          length: [12, 13, 14, 15, 16, 17, 18, 19],
          prefix: ["5018", "5020", "5038", "5868", "6304", "6759", "6761", "6762", "6763", "6764", "6765", "6766"]
        },
        MASTERCARD: {
          length: [16],
          prefix: ["51", "52", "53", "54", "55"]
        },
        SOLO: {
          length: [16, 18, 19],
          prefix: ["6334", "6767"]
        },
        UNIONPAY: {
          length: [16, 17, 18, 19],
          prefix: [
            "622126",
            "622127",
            "622128",
            "622129",
            "62213",
            "62214",
            "62215",
            "62216",
            "62217",
            "62218",
            "62219",
            "6222",
            "6223",
            "6224",
            "6225",
            "6226",
            "6227",
            "6228",
            "62290",
            "62291",
            "622920",
            "622921",
            "622922",
            "622923",
            "622924",
            "622925"
          ]
        },
        VISA: {
          length: [16],
          prefix: ["4"]
        },
        VISA_ELECTRON: {
          length: [16],
          prefix: ["4026", "417500", "4405", "4508", "4844", "4913", "4917"]
        }
      };
      function creditCard() {
        return {
          /**
           * Return true if the input value is valid credit card number
           */
          validate: function(input) {
            if (input.value === "") {
              return {
                meta: {
                  type: null
                },
                valid: true
              };
            }
            if (/[^0-9-\s]+/.test(input.value)) {
              return {
                meta: {
                  type: null
                },
                valid: false
              };
            }
            var v = input.value.replace(/\D/g, "");
            if (!luhn(v)) {
              return {
                meta: {
                  type: null
                },
                valid: false
              };
            }
            for (var _i = 0, _a = Object.keys(CREDIT_CARD_TYPES); _i < _a.length; _i++) {
              var tpe = _a[_i];
              for (var i in CREDIT_CARD_TYPES[tpe].prefix) {
                if (input.value.substr(0, CREDIT_CARD_TYPES[tpe].prefix[i].length) === CREDIT_CARD_TYPES[tpe].prefix[i] && CREDIT_CARD_TYPES[tpe].length.indexOf(v.length) !== -1) {
                  return {
                    meta: {
                      type: tpe
                    },
                    valid: true
                  };
                }
              }
            }
            return {
              meta: {
                type: null
              },
              valid: false
            };
          }
        };
      }
      cjs$i.CREDIT_CARD_TYPES = CREDIT_CARD_TYPES;
      cjs$i.creditCard = creditCard;
      return cjs$i;
    }
    if (false) {
      lib$i.exports = requireIndex_min$i();
    } else {
      lib$i.exports = requireCjs$i();
    }
    var libExports$i = lib$i.exports;
    var lib$h = { exports: {} };
    var cjs$h = {};
    var hasRequiredCjs$h;
    function requireCjs$h() {
      if (hasRequiredCjs$h)
        return cjs$h;
      hasRequiredCjs$h = 1;
      var core = libExports$B;
      var format = core.utils.format, isValidDate = core.utils.isValidDate, removeUndefined = core.utils.removeUndefined;
      var parseDate = function(input, inputFormat, separator) {
        var yearIndex = inputFormat.indexOf("YYYY");
        var monthIndex = inputFormat.indexOf("MM");
        var dayIndex = inputFormat.indexOf("DD");
        if (yearIndex === -1 || monthIndex === -1 || dayIndex === -1) {
          return null;
        }
        var sections = input.split(" ");
        var dateSection = sections[0].split(separator);
        if (dateSection.length < 3) {
          return null;
        }
        var d = new Date(parseInt(dateSection[yearIndex], 10), parseInt(dateSection[monthIndex], 10) - 1, parseInt(dateSection[dayIndex], 10));
        var amPmSection = sections.length > 2 ? sections[2] : null;
        if (sections.length > 1) {
          var timeSection = sections[1].split(":");
          var h = timeSection.length > 0 ? parseInt(timeSection[0], 10) : 0;
          d.setHours(amPmSection && amPmSection.toUpperCase() === "PM" && h < 12 ? h + 12 : h);
          d.setMinutes(timeSection.length > 1 ? parseInt(timeSection[1], 10) : 0);
          d.setSeconds(timeSection.length > 2 ? parseInt(timeSection[2], 10) : 0);
        }
        return d;
      };
      var formatDate = function(input, inputFormat) {
        var dateFormat = inputFormat.replace(/Y/g, "y").replace(/M/g, "m").replace(/D/g, "d").replace(/:m/g, ":M").replace(/:mm/g, ":MM").replace(/:S/, ":s").replace(/:SS/, ":ss");
        var d = input.getDate();
        var dd = d < 10 ? "0".concat(d) : d;
        var m = input.getMonth() + 1;
        var mm = m < 10 ? "0".concat(m) : m;
        var yy = "".concat(input.getFullYear()).substr(2);
        var yyyy = input.getFullYear();
        var h = input.getHours() % 12 || 12;
        var hh = h < 10 ? "0".concat(h) : h;
        var H = input.getHours();
        var HH = H < 10 ? "0".concat(H) : H;
        var M = input.getMinutes();
        var MM = M < 10 ? "0".concat(M) : M;
        var s = input.getSeconds();
        var ss = s < 10 ? "0".concat(s) : s;
        var replacer = {
          H: "".concat(H),
          HH: "".concat(HH),
          M: "".concat(M),
          MM: "".concat(MM),
          d: "".concat(d),
          dd: "".concat(dd),
          h: "".concat(h),
          hh: "".concat(hh),
          m: "".concat(m),
          mm: "".concat(mm),
          s: "".concat(s),
          ss: "".concat(ss),
          yy: "".concat(yy),
          yyyy: "".concat(yyyy)
        };
        return dateFormat.replace(/d{1,4}|m{1,4}|yy(?:yy)?|([HhMs])\1?|"[^"]*"|'[^']*'/g, function(match) {
          return replacer[match] ? replacer[match] : match.slice(1, match.length - 1);
        });
      };
      var date = function() {
        return {
          validate: function(input) {
            if (input.value === "") {
              return {
                meta: {
                  date: null
                },
                valid: true
              };
            }
            var opts = Object.assign({}, {
              // Force the format to `YYYY-MM-DD` as the default browser behaviour when using type="date" attribute
              format: input.element && input.element.getAttribute("type") === "date" ? "YYYY-MM-DD" : "MM/DD/YYYY",
              message: ""
            }, removeUndefined(input.options));
            var message = input.l10n ? input.l10n.date.default : opts.message;
            var invalidResult = {
              message: "".concat(message),
              meta: {
                date: null
              },
              valid: false
            };
            var formats = opts.format.split(" ");
            var timeFormat = formats.length > 1 ? formats[1] : null;
            var amOrPm = formats.length > 2 ? formats[2] : null;
            var sections = input.value.split(" ");
            var dateSection = sections[0];
            var timeSection = sections.length > 1 ? sections[1] : null;
            var amPmSection = sections.length > 2 ? sections[2] : null;
            if (formats.length !== sections.length) {
              return invalidResult;
            }
            var separator = opts.separator || (dateSection.indexOf("/") !== -1 ? "/" : dateSection.indexOf("-") !== -1 ? "-" : dateSection.indexOf(".") !== -1 ? "." : "/");
            if (separator === null || dateSection.indexOf(separator) === -1) {
              return invalidResult;
            }
            var dateStr = dateSection.split(separator);
            var dateFormat = formats[0].split(separator);
            if (dateStr.length !== dateFormat.length) {
              return invalidResult;
            }
            var yearStr = dateStr[dateFormat.indexOf("YYYY")];
            var monthStr = dateStr[dateFormat.indexOf("MM")];
            var dayStr = dateStr[dateFormat.indexOf("DD")];
            if (!/^\d+$/.test(yearStr) || !/^\d+$/.test(monthStr) || !/^\d+$/.test(dayStr) || yearStr.length > 4 || monthStr.length > 2 || dayStr.length > 2) {
              return invalidResult;
            }
            var year = parseInt(yearStr, 10);
            var month = parseInt(monthStr, 10);
            var day = parseInt(dayStr, 10);
            if (!isValidDate(year, month, day)) {
              return invalidResult;
            }
            var d = new Date(year, month - 1, day);
            if (timeFormat) {
              var hms = timeSection.split(":");
              if (timeFormat.split(":").length !== hms.length) {
                return invalidResult;
              }
              var h = hms.length > 0 ? hms[0].length <= 2 && /^\d+$/.test(hms[0]) ? parseInt(hms[0], 10) : -1 : 0;
              var m = hms.length > 1 ? hms[1].length <= 2 && /^\d+$/.test(hms[1]) ? parseInt(hms[1], 10) : -1 : 0;
              var s = hms.length > 2 ? hms[2].length <= 2 && /^\d+$/.test(hms[2]) ? parseInt(hms[2], 10) : -1 : 0;
              if (h === -1 || m === -1 || s === -1) {
                return invalidResult;
              }
              if (s < 0 || s > 60) {
                return invalidResult;
              }
              if (h < 0 || h >= 24 || amOrPm && h > 12) {
                return invalidResult;
              }
              if (m < 0 || m > 59) {
                return invalidResult;
              }
              d.setHours(amPmSection && amPmSection.toUpperCase() === "PM" && h < 12 ? h + 12 : h);
              d.setMinutes(m);
              d.setSeconds(s);
            }
            var minOption = typeof opts.min === "function" ? opts.min() : opts.min;
            var min = minOption instanceof Date ? minOption : minOption ? parseDate(minOption, dateFormat, separator) : d;
            var maxOption = typeof opts.max === "function" ? opts.max() : opts.max;
            var max = maxOption instanceof Date ? maxOption : maxOption ? parseDate(maxOption, dateFormat, separator) : d;
            var minOptionStr = minOption instanceof Date ? formatDate(min, opts.format) : minOption;
            var maxOptionStr = maxOption instanceof Date ? formatDate(max, opts.format) : maxOption;
            switch (true) {
              case (!!minOptionStr && !maxOptionStr):
                return {
                  message: format(input.l10n ? input.l10n.date.min : message, minOptionStr),
                  meta: {
                    date: d
                  },
                  valid: d.getTime() >= min.getTime()
                };
              case (!!maxOptionStr && !minOptionStr):
                return {
                  message: format(input.l10n ? input.l10n.date.max : message, maxOptionStr),
                  meta: {
                    date: d
                  },
                  valid: d.getTime() <= max.getTime()
                };
              case (!!maxOptionStr && !!minOptionStr):
                return {
                  message: format(input.l10n ? input.l10n.date.range : message, [minOptionStr, maxOptionStr]),
                  meta: {
                    date: d
                  },
                  valid: d.getTime() <= max.getTime() && d.getTime() >= min.getTime()
                };
              default:
                return {
                  message: "".concat(message),
                  meta: {
                    date: d
                  },
                  valid: true
                };
            }
          }
        };
      };
      cjs$h.date = date;
      return cjs$h;
    }
    if (false) {
      lib$h.exports = requireIndex_min$h();
    } else {
      lib$h.exports = requireCjs$h();
    }
    var libExports$h = lib$h.exports;
    var lib$g = { exports: {} };
    var cjs$g = {};
    var hasRequiredCjs$g;
    function requireCjs$g() {
      if (hasRequiredCjs$g)
        return cjs$g;
      hasRequiredCjs$g = 1;
      function different() {
        return {
          validate: function(input) {
            var compareWith = "function" === typeof input.options.compare ? input.options.compare.call(this) : input.options.compare;
            return {
              valid: compareWith === "" || input.value !== compareWith
            };
          }
        };
      }
      cjs$g.different = different;
      return cjs$g;
    }
    if (false) {
      lib$g.exports = requireIndex_min$g();
    } else {
      lib$g.exports = requireCjs$g();
    }
    var libExports$g = lib$g.exports;
    var lib$f = { exports: {} };
    var cjs$f = {};
    var hasRequiredCjs$f;
    function requireCjs$f() {
      if (hasRequiredCjs$f)
        return cjs$f;
      hasRequiredCjs$f = 1;
      function digits() {
        return {
          /**
           * Return true if the input value contains digits only
           */
          validate: function(input) {
            return { valid: input.value === "" || /^\d+$/.test(input.value) };
          }
        };
      }
      cjs$f.digits = digits;
      return cjs$f;
    }
    if (false) {
      lib$f.exports = requireIndex_min$f();
    } else {
      lib$f.exports = requireCjs$f();
    }
    var libExports$f = lib$f.exports;
    var lib$e = { exports: {} };
    var cjs$e = {};
    var hasRequiredCjs$e;
    function requireCjs$e() {
      if (hasRequiredCjs$e)
        return cjs$e;
      hasRequiredCjs$e = 1;
      var core = libExports$B;
      var removeUndefined = core.utils.removeUndefined;
      var GLOBAL_DOMAIN_OPTIONAL = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
      var GLOBAL_DOMAIN_REQUIRED = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)+$/;
      function emailAddress() {
        var splitEmailAddresses = function(emailAddresses, separator) {
          var quotedFragments = emailAddresses.split(/"/);
          var quotedFragmentCount = quotedFragments.length;
          var emailAddressArray = [];
          var nextEmailAddress = "";
          for (var i = 0; i < quotedFragmentCount; i++) {
            if (i % 2 === 0) {
              var splitEmailAddressFragments = quotedFragments[i].split(separator);
              var splitEmailAddressFragmentCount = splitEmailAddressFragments.length;
              if (splitEmailAddressFragmentCount === 1) {
                nextEmailAddress += splitEmailAddressFragments[0];
              } else {
                emailAddressArray.push(nextEmailAddress + splitEmailAddressFragments[0]);
                for (var j = 1; j < splitEmailAddressFragmentCount - 1; j++) {
                  emailAddressArray.push(splitEmailAddressFragments[j]);
                }
                nextEmailAddress = splitEmailAddressFragments[splitEmailAddressFragmentCount - 1];
              }
            } else {
              nextEmailAddress += '"' + quotedFragments[i];
              if (i < quotedFragmentCount - 1) {
                nextEmailAddress += '"';
              }
            }
          }
          emailAddressArray.push(nextEmailAddress);
          return emailAddressArray;
        };
        return {
          /**
           * Return true if and only if the input value is a valid email address
           */
          validate: function(input) {
            if (input.value === "") {
              return { valid: true };
            }
            var opts = Object.assign({}, {
              multiple: false,
              requireGlobalDomain: false,
              separator: /[,;]/
            }, removeUndefined(input.options));
            var emailRegExp = opts.requireGlobalDomain ? GLOBAL_DOMAIN_REQUIRED : GLOBAL_DOMAIN_OPTIONAL;
            var allowMultiple = opts.multiple === true || "".concat(opts.multiple) === "true";
            if (allowMultiple) {
              var separator = opts.separator || /[,;]/;
              var addresses = splitEmailAddresses(input.value, separator);
              var length_1 = addresses.length;
              for (var i = 0; i < length_1; i++) {
                if (!emailRegExp.test(addresses[i])) {
                  return { valid: false };
                }
              }
              return { valid: true };
            } else {
              return { valid: emailRegExp.test(input.value) };
            }
          }
        };
      }
      cjs$e.emailAddress = emailAddress;
      return cjs$e;
    }
    if (false) {
      lib$e.exports = requireIndex_min$e();
    } else {
      lib$e.exports = requireCjs$e();
    }
    var libExports$e = lib$e.exports;
    var lib$d = { exports: {} };
    var cjs$d = {};
    var hasRequiredCjs$d;
    function requireCjs$d() {
      if (hasRequiredCjs$d)
        return cjs$d;
      hasRequiredCjs$d = 1;
      var getFileName = function(fileName) {
        return fileName.indexOf(".") === -1 ? fileName : fileName.split(".").slice(0, -1).join(".");
      };
      function file() {
        return {
          validate: function(input) {
            if (input.value === "") {
              return { valid: true };
            }
            var extension;
            var name;
            var extensions = input.options.extension ? input.options.extension.toLowerCase().split(",").map(function(item) {
              return item.trim();
            }) : [];
            var types = input.options.type ? input.options.type.toLowerCase().split(",").map(function(item) {
              return item.trim();
            }) : [];
            var html5 = window["File"] && window["FileList"] && window["FileReader"];
            if (html5) {
              var files = input.element.files;
              var total = files.length;
              var allSize = 0;
              if (input.options.maxFiles && total > parseInt("".concat(input.options.maxFiles), 10)) {
                return {
                  meta: { error: "INVALID_MAX_FILES" },
                  valid: false
                };
              }
              if (input.options.minFiles && total < parseInt("".concat(input.options.minFiles), 10)) {
                return {
                  meta: { error: "INVALID_MIN_FILES" },
                  valid: false
                };
              }
              var metaData = {};
              for (var i = 0; i < total; i++) {
                allSize += files[i].size;
                extension = files[i].name.substr(files[i].name.lastIndexOf(".") + 1);
                metaData = {
                  ext: extension,
                  file: files[i],
                  size: files[i].size,
                  type: files[i].type
                };
                if (input.options.minSize && files[i].size < parseInt("".concat(input.options.minSize), 10)) {
                  return {
                    meta: Object.assign({}, { error: "INVALID_MIN_SIZE" }, metaData),
                    valid: false
                  };
                }
                if (input.options.maxSize && files[i].size > parseInt("".concat(input.options.maxSize), 10)) {
                  return {
                    meta: Object.assign({}, { error: "INVALID_MAX_SIZE" }, metaData),
                    valid: false
                  };
                }
                if (extensions.length > 0 && extensions.indexOf(extension.toLowerCase()) === -1) {
                  return {
                    meta: Object.assign({}, { error: "INVALID_EXTENSION" }, metaData),
                    valid: false
                  };
                }
                if (types.length > 0 && files[i].type && types.indexOf(files[i].type.toLowerCase()) === -1) {
                  return {
                    meta: Object.assign({}, { error: "INVALID_TYPE" }, metaData),
                    valid: false
                  };
                }
                if (input.options.validateFileName && !input.options.validateFileName(getFileName(files[i].name))) {
                  return {
                    meta: Object.assign({}, { error: "INVALID_NAME" }, metaData),
                    valid: false
                  };
                }
              }
              if (input.options.maxTotalSize && allSize > parseInt("".concat(input.options.maxTotalSize), 10)) {
                return {
                  meta: Object.assign({}, {
                    error: "INVALID_MAX_TOTAL_SIZE",
                    totalSize: allSize
                  }, metaData),
                  valid: false
                };
              }
              if (input.options.minTotalSize && allSize < parseInt("".concat(input.options.minTotalSize), 10)) {
                return {
                  meta: Object.assign({}, {
                    error: "INVALID_MIN_TOTAL_SIZE",
                    totalSize: allSize
                  }, metaData),
                  valid: false
                };
              }
            } else {
              extension = input.value.substr(input.value.lastIndexOf(".") + 1);
              if (extensions.length > 0 && extensions.indexOf(extension.toLowerCase()) === -1) {
                return {
                  meta: {
                    error: "INVALID_EXTENSION",
                    ext: extension
                  },
                  valid: false
                };
              }
              name = getFileName(input.value);
              if (input.options.validateFileName && !input.options.validateFileName(name)) {
                return {
                  meta: {
                    error: "INVALID_NAME",
                    name
                  },
                  valid: false
                };
              }
            }
            return { valid: true };
          }
        };
      }
      cjs$d.file = file;
      return cjs$d;
    }
    if (false) {
      lib$d.exports = requireIndex_min$d();
    } else {
      lib$d.exports = requireCjs$d();
    }
    var libExports$d = lib$d.exports;
    var lib$c = { exports: {} };
    var cjs$c = {};
    var hasRequiredCjs$c;
    function requireCjs$c() {
      if (hasRequiredCjs$c)
        return cjs$c;
      hasRequiredCjs$c = 1;
      var core = libExports$B;
      var format = core.utils.format, removeUndefined = core.utils.removeUndefined;
      function greaterThan() {
        return {
          validate: function(input) {
            if (input.value === "") {
              return { valid: true };
            }
            var opts = Object.assign({}, { inclusive: true, message: "" }, removeUndefined(input.options));
            var minValue = parseFloat("".concat(opts.min).replace(",", "."));
            return opts.inclusive ? {
              message: format(input.l10n ? opts.message || input.l10n.greaterThan.default : opts.message, "".concat(minValue)),
              valid: parseFloat(input.value) >= minValue
            } : {
              message: format(input.l10n ? opts.message || input.l10n.greaterThan.notInclusive : opts.message, "".concat(minValue)),
              valid: parseFloat(input.value) > minValue
            };
          }
        };
      }
      cjs$c.greaterThan = greaterThan;
      return cjs$c;
    }
    if (false) {
      lib$c.exports = requireIndex_min$c();
    } else {
      lib$c.exports = requireCjs$c();
    }
    var libExports$c = lib$c.exports;
    var lib$b = { exports: {} };
    var cjs$b = {};
    var hasRequiredCjs$b;
    function requireCjs$b() {
      if (hasRequiredCjs$b)
        return cjs$b;
      hasRequiredCjs$b = 1;
      function identical() {
        return {
          validate: function(input) {
            var compareWith = "function" === typeof input.options.compare ? input.options.compare.call(this) : input.options.compare;
            return {
              valid: compareWith === "" || input.value === compareWith
            };
          }
        };
      }
      cjs$b.identical = identical;
      return cjs$b;
    }
    if (false) {
      lib$b.exports = requireIndex_min$b();
    } else {
      lib$b.exports = requireCjs$b();
    }
    var libExports$b = lib$b.exports;
    var lib$a = { exports: {} };
    var cjs$a = {};
    var hasRequiredCjs$a;
    function requireCjs$a() {
      if (hasRequiredCjs$a)
        return cjs$a;
      hasRequiredCjs$a = 1;
      var core = libExports$B;
      var removeUndefined = core.utils.removeUndefined;
      function integer() {
        return {
          validate: function(input) {
            if (input.value === "") {
              return { valid: true };
            }
            var opts = Object.assign({}, {
              decimalSeparator: ".",
              thousandsSeparator: ""
            }, removeUndefined(input.options));
            var decimalSeparator = opts.decimalSeparator === "." ? "\\." : opts.decimalSeparator;
            var thousandsSeparator = opts.thousandsSeparator === "." ? "\\." : opts.thousandsSeparator;
            var testRegexp = new RegExp("^-?[0-9]{1,3}(".concat(thousandsSeparator, "[0-9]{3})*(").concat(decimalSeparator, "[0-9]+)?$"));
            var thousandsReplacer = new RegExp(thousandsSeparator, "g");
            var v = "".concat(input.value);
            if (!testRegexp.test(v)) {
              return { valid: false };
            }
            if (thousandsSeparator) {
              v = v.replace(thousandsReplacer, "");
            }
            if (decimalSeparator) {
              v = v.replace(decimalSeparator, ".");
            }
            var n = parseFloat(v);
            return { valid: !isNaN(n) && isFinite(n) && Math.floor(n) === n };
          }
        };
      }
      cjs$a.integer = integer;
      return cjs$a;
    }
    if (false) {
      lib$a.exports = requireIndex_min$a();
    } else {
      lib$a.exports = requireCjs$a();
    }
    var libExports$a = lib$a.exports;
    var lib$9 = { exports: {} };
    var cjs$9 = {};
    var hasRequiredCjs$9;
    function requireCjs$9() {
      if (hasRequiredCjs$9)
        return cjs$9;
      hasRequiredCjs$9 = 1;
      var core = libExports$B;
      var removeUndefined = core.utils.removeUndefined;
      function ip() {
        return {
          /**
           * Return true if the input value is a IP address.
           */
          validate: function(input) {
            if (input.value === "") {
              return { valid: true };
            }
            var opts = Object.assign({}, {
              ipv4: true,
              ipv6: true
            }, removeUndefined(input.options));
            var ipv4Regex = /^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)(\/([0-9]|[1-2][0-9]|3[0-2]))?$/;
            var ipv6Regex = /^\s*((([0-9A-Fa-f]{1,4}:){7}([0-9A-Fa-f]{1,4}|:))|(([0-9A-Fa-f]{1,4}:){6}(:[0-9A-Fa-f]{1,4}|((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3})|:))|(([0-9A-Fa-f]{1,4}:){5}(((:[0-9A-Fa-f]{1,4}){1,2})|:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3})|:))|(([0-9A-Fa-f]{1,4}:){4}(((:[0-9A-Fa-f]{1,4}){1,3})|((:[0-9A-Fa-f]{1,4})?:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){3}(((:[0-9A-Fa-f]{1,4}){1,4})|((:[0-9A-Fa-f]{1,4}){0,2}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){2}(((:[0-9A-Fa-f]{1,4}){1,5})|((:[0-9A-Fa-f]{1,4}){0,3}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){1}(((:[0-9A-Fa-f]{1,4}){1,6})|((:[0-9A-Fa-f]{1,4}){0,4}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(:(((:[0-9A-Fa-f]{1,4}){1,7})|((:[0-9A-Fa-f]{1,4}){0,5}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:)))(%.+)?\s*(\/(\d|\d\d|1[0-1]\d|12[0-8]))?$/;
            switch (true) {
              case (opts.ipv4 && !opts.ipv6):
                return {
                  message: input.l10n ? opts.message || input.l10n.ip.ipv4 : opts.message,
                  valid: ipv4Regex.test(input.value)
                };
              case (!opts.ipv4 && opts.ipv6):
                return {
                  message: input.l10n ? opts.message || input.l10n.ip.ipv6 : opts.message,
                  valid: ipv6Regex.test(input.value)
                };
              case (opts.ipv4 && opts.ipv6):
              default:
                return {
                  message: input.l10n ? opts.message || input.l10n.ip.default : opts.message,
                  valid: ipv4Regex.test(input.value) || ipv6Regex.test(input.value)
                };
            }
          }
        };
      }
      cjs$9.ip = ip;
      return cjs$9;
    }
    if (false) {
      lib$9.exports = requireIndex_min$9();
    } else {
      lib$9.exports = requireCjs$9();
    }
    var libExports$9 = lib$9.exports;
    var lib$8 = { exports: {} };
    var cjs$8 = {};
    var hasRequiredCjs$8;
    function requireCjs$8() {
      if (hasRequiredCjs$8)
        return cjs$8;
      hasRequiredCjs$8 = 1;
      var core = libExports$B;
      var format = core.utils.format, removeUndefined = core.utils.removeUndefined;
      function lessThan() {
        return {
          validate: function(input) {
            if (input.value === "") {
              return { valid: true };
            }
            var opts = Object.assign({}, { inclusive: true, message: "" }, removeUndefined(input.options));
            var maxValue = parseFloat("".concat(opts.max).replace(",", "."));
            return opts.inclusive ? {
              message: format(input.l10n ? opts.message || input.l10n.lessThan.default : opts.message, "".concat(maxValue)),
              valid: parseFloat(input.value) <= maxValue
            } : {
              message: format(input.l10n ? opts.message || input.l10n.lessThan.notInclusive : opts.message, "".concat(maxValue)),
              valid: parseFloat(input.value) < maxValue
            };
          }
        };
      }
      cjs$8.lessThan = lessThan;
      return cjs$8;
    }
    if (false) {
      lib$8.exports = requireIndex_min$8();
    } else {
      lib$8.exports = requireCjs$8();
    }
    var libExports$8 = lib$8.exports;
    var lib$7 = { exports: {} };
    var cjs$7 = {};
    var hasRequiredCjs$7;
    function requireCjs$7() {
      if (hasRequiredCjs$7)
        return cjs$7;
      hasRequiredCjs$7 = 1;
      function notEmpty() {
        return {
          validate: function(input) {
            var trim = !!input.options && !!input.options.trim;
            var value = input.value;
            return {
              valid: !trim && value !== "" || trim && value !== "" && value.trim() !== ""
            };
          }
        };
      }
      cjs$7.notEmpty = notEmpty;
      return cjs$7;
    }
    if (false) {
      lib$7.exports = requireIndex_min$7();
    } else {
      lib$7.exports = requireCjs$7();
    }
    var libExports$7 = lib$7.exports;
    var lib$6 = { exports: {} };
    var cjs$6 = {};
    var hasRequiredCjs$6;
    function requireCjs$6() {
      if (hasRequiredCjs$6)
        return cjs$6;
      hasRequiredCjs$6 = 1;
      var core = libExports$B;
      var removeUndefined = core.utils.removeUndefined;
      function numeric() {
        return {
          validate: function(input) {
            if (input.value === "") {
              return { valid: true };
            }
            var opts = Object.assign({}, {
              decimalSeparator: ".",
              thousandsSeparator: ""
            }, removeUndefined(input.options));
            var v = "".concat(input.value);
            if (v.substr(0, 1) === opts.decimalSeparator) {
              v = "0".concat(opts.decimalSeparator).concat(v.substr(1));
            } else if (v.substr(0, 2) === "-".concat(opts.decimalSeparator)) {
              v = "-0".concat(opts.decimalSeparator).concat(v.substr(2));
            }
            var decimalSeparator = opts.decimalSeparator === "." ? "\\." : opts.decimalSeparator;
            var thousandsSeparator = opts.thousandsSeparator === "." ? "\\." : opts.thousandsSeparator;
            var testRegexp = new RegExp("^-?[0-9]{1,3}(".concat(thousandsSeparator, "[0-9]{3})*(").concat(decimalSeparator, "[0-9]+)?$"));
            var thousandsReplacer = new RegExp(thousandsSeparator, "g");
            if (!testRegexp.test(v)) {
              return { valid: false };
            }
            if (thousandsSeparator) {
              v = v.replace(thousandsReplacer, "");
            }
            if (decimalSeparator) {
              v = v.replace(decimalSeparator, ".");
            }
            var n = parseFloat(v);
            return { valid: !isNaN(n) && isFinite(n) };
          }
        };
      }
      cjs$6.numeric = numeric;
      return cjs$6;
    }
    if (false) {
      lib$6.exports = requireIndex_min$6();
    } else {
      lib$6.exports = requireCjs$6();
    }
    var libExports$6 = lib$6.exports;
    var lib$5 = { exports: {} };
    var cjs$5 = {};
    var hasRequiredCjs$5;
    function requireCjs$5() {
      if (hasRequiredCjs$5)
        return cjs$5;
      hasRequiredCjs$5 = 1;
      var core = libExports$B;
      var call = core.utils.call;
      function promise() {
        return {
          /**
           * The following example demonstrates how to use a promise validator to requires both width and height
           * of an image to be less than 300 px
           *  ```
           *  const p = new Promise((resolve, reject) => {
           *      const img = new Image()
           *      img.addEventListener('load', function() {
           *          const w = this.width
           *          const h = this.height
           *          resolve({
           *              valid: w <= 300 && h <= 300
           *              meta: {
           *                  source: img.src // So, you can reuse it later if you want
           *              }
           *          })
           *      })
           *      img.addEventListener('error', function() {
           *          reject({
           *              valid: false,
           *              message: Please choose an image
           *          })
           *      })
           *  })
           *  ```
           *
           * @param input
           * @return {Promise<ValidateResult>}
           */
          validate: function(input) {
            return call(input.options.promise, [input]);
          }
        };
      }
      cjs$5.promise = promise;
      return cjs$5;
    }
    if (false) {
      lib$5.exports = requireIndex_min$5();
    } else {
      lib$5.exports = requireCjs$5();
    }
    var libExports$5 = lib$5.exports;
    var lib$4 = { exports: {} };
    var cjs$4 = {};
    var hasRequiredCjs$4;
    function requireCjs$4() {
      if (hasRequiredCjs$4)
        return cjs$4;
      hasRequiredCjs$4 = 1;
      function regexp() {
        return {
          /**
           * Check if the element value matches given regular expression
           */
          validate: function(input) {
            if (input.value === "") {
              return { valid: true };
            }
            var reg = input.options.regexp;
            if (reg instanceof RegExp) {
              return { valid: reg.test(input.value) };
            } else {
              var pattern = reg.toString();
              var exp = input.options.flags ? new RegExp(pattern, input.options.flags) : new RegExp(pattern);
              return { valid: exp.test(input.value) };
            }
          }
        };
      }
      cjs$4.regexp = regexp;
      return cjs$4;
    }
    if (false) {
      lib$4.exports = requireIndex_min$4();
    } else {
      lib$4.exports = requireCjs$4();
    }
    var libExports$4 = lib$4.exports;
    var lib$3 = { exports: {} };
    var cjs$3 = {};
    var hasRequiredCjs$3;
    function requireCjs$3() {
      if (hasRequiredCjs$3)
        return cjs$3;
      hasRequiredCjs$3 = 1;
      var core = libExports$B;
      var fetch = core.utils.fetch, removeUndefined = core.utils.removeUndefined;
      function remote() {
        var DEFAULT_OPTIONS = {
          crossDomain: false,
          data: {},
          headers: {},
          method: "GET",
          validKey: "valid"
        };
        return {
          validate: function(input) {
            if (input.value === "") {
              return Promise.resolve({
                valid: true
              });
            }
            var opts = Object.assign({}, DEFAULT_OPTIONS, removeUndefined(input.options));
            var data = opts.data;
            if ("function" === typeof opts.data) {
              data = opts.data.call(this, input);
            }
            if ("string" === typeof data) {
              data = JSON.parse(data);
            }
            data[opts.name || input.field] = input.value;
            var url = "function" === typeof opts.url ? opts.url.call(this, input) : opts.url;
            return fetch(url, {
              crossDomain: opts.crossDomain,
              headers: opts.headers,
              method: opts.method,
              params: data
            }).then(function(response) {
              return Promise.resolve({
                message: response["message"],
                meta: response,
                valid: "".concat(response[opts.validKey]) === "true"
              });
            }).catch(function(_reason) {
              return Promise.reject({
                valid: false
              });
            });
          }
        };
      }
      cjs$3.remote = remote;
      return cjs$3;
    }
    if (false) {
      lib$3.exports = requireIndex_min$3();
    } else {
      lib$3.exports = requireCjs$3();
    }
    var libExports$3 = lib$3.exports;
    var lib$2 = { exports: {} };
    var cjs$2 = {};
    var hasRequiredCjs$2;
    function requireCjs$2() {
      if (hasRequiredCjs$2)
        return cjs$2;
      hasRequiredCjs$2 = 1;
      var core = libExports$B;
      var removeUndefined = core.utils.removeUndefined;
      function stringCase() {
        return {
          /**
           * Check if a string is a lower or upper case one
           */
          validate: function(input) {
            if (input.value === "") {
              return { valid: true };
            }
            var opts = Object.assign({}, { case: "lower" }, removeUndefined(input.options));
            var caseOpt = (opts.case || "lower").toLowerCase();
            return {
              message: opts.message || (input.l10n ? "upper" === caseOpt ? input.l10n.stringCase.upper : input.l10n.stringCase.default : opts.message),
              valid: "upper" === caseOpt ? input.value === input.value.toUpperCase() : input.value === input.value.toLowerCase()
            };
          }
        };
      }
      cjs$2.stringCase = stringCase;
      return cjs$2;
    }
    if (false) {
      lib$2.exports = requireIndex_min$2();
    } else {
      lib$2.exports = requireCjs$2();
    }
    var libExports$2 = lib$2.exports;
    var lib$1 = { exports: {} };
    var cjs$1 = {};
    var hasRequiredCjs$1;
    function requireCjs$1() {
      if (hasRequiredCjs$1)
        return cjs$1;
      hasRequiredCjs$1 = 1;
      var core = libExports$B;
      var format = core.utils.format, removeUndefined = core.utils.removeUndefined;
      var utf8Length = function(str) {
        var s = str.length;
        for (var i = str.length - 1; i >= 0; i--) {
          var code = str.charCodeAt(i);
          if (code > 127 && code <= 2047) {
            s++;
          } else if (code > 2047 && code <= 65535) {
            s += 2;
          }
          if (code >= 56320 && code <= 57343) {
            i--;
          }
        }
        return s;
      };
      function stringLength() {
        return {
          /**
           * Check if the length of element value is less or more than given number
           */
          validate: function(input) {
            var opts = Object.assign({}, {
              message: "",
              trim: false,
              utf8Bytes: false
            }, removeUndefined(input.options));
            var v = opts.trim === true || "".concat(opts.trim) === "true" ? input.value.trim() : input.value;
            if (v === "") {
              return { valid: true };
            }
            var min = opts.min ? "".concat(opts.min) : "";
            var max = opts.max ? "".concat(opts.max) : "";
            var length = opts.utf8Bytes ? utf8Length(v) : v.length;
            var isValid = true;
            var msg = input.l10n ? opts.message || input.l10n.stringLength.default : opts.message;
            if (min && length < parseInt(min, 10) || max && length > parseInt(max, 10)) {
              isValid = false;
            }
            switch (true) {
              case (!!min && !!max):
                msg = format(input.l10n ? opts.message || input.l10n.stringLength.between : opts.message, [
                  min,
                  max
                ]);
                break;
              case !!min:
                msg = format(input.l10n ? opts.message || input.l10n.stringLength.more : opts.message, "".concat(parseInt(min, 10)));
                break;
              case !!max:
                msg = format(input.l10n ? opts.message || input.l10n.stringLength.less : opts.message, "".concat(parseInt(max, 10)));
                break;
            }
            return {
              message: msg,
              valid: isValid
            };
          }
        };
      }
      cjs$1.stringLength = stringLength;
      return cjs$1;
    }
    if (false) {
      lib$1.exports = requireIndex_min$1();
    } else {
      lib$1.exports = requireCjs$1();
    }
    var libExports$1 = lib$1.exports;
    var lib = { exports: {} };
    var cjs = {};
    var hasRequiredCjs;
    function requireCjs() {
      if (hasRequiredCjs)
        return cjs;
      hasRequiredCjs = 1;
      var core = libExports$B;
      var removeUndefined = core.utils.removeUndefined;
      function uri() {
        var DEFAULT_OPTIONS = {
          allowEmptyProtocol: false,
          allowLocal: false,
          protocol: "http, https, ftp"
        };
        return {
          /**
           * Return true if the input value is a valid URL
           */
          validate: function(input) {
            if (input.value === "") {
              return { valid: true };
            }
            var opts = Object.assign({}, DEFAULT_OPTIONS, removeUndefined(input.options));
            var allowLocal = opts.allowLocal === true || "".concat(opts.allowLocal) === "true";
            var allowEmptyProtocol = opts.allowEmptyProtocol === true || "".concat(opts.allowEmptyProtocol) === "true";
            var protocol = opts.protocol.split(",").join("|").replace(/\s/g, "");
            var urlExp = new RegExp("^(?:(?:" + protocol + ")://)" + // allow empty protocol
            (allowEmptyProtocol ? "?" : "") + // user:pass authentication
            "(?:\\S+(?::\\S*)?@)?(?:" + // IP address exclusion
            // private & local networks
            (allowLocal ? "" : "(?!(?:10|127)(?:\\.\\d{1,3}){3})(?!(?:169\\.254|192\\.168)(?:\\.\\d{1,3}){2})(?!172\\.(?:1[6-9]|2\\d|3[0-1])(?:\\.\\d{1,3}){2})") + // IP address dotted notation octets
            // excludes loopback network 0.0.0.0
            // excludes reserved space >= 224.0.0.0
            // excludes network & broadcast addresses
            // (first & last IP address of each class)
            "(?:[1-9]\\d?|1\\d\\d|2[01]\\d|22[0-3])(?:\\.(?:1?\\d{1,2}|2[0-4]\\d|25[0-5])){2}(?:\\.(?:[1-9]\\d?|1\\d\\d|2[0-4]\\d|25[0-4]))|(?:(?:[a-z\\u00a1-\\uffff0-9]-?)*[a-z\\u00a1-\\uffff0-9]+)(?:\\.(?:[a-z\\u00a1-\\uffff0-9]-?)*[a-z\\u00a1-\\uffff0-9])*(?:\\.(?:[a-z\\u00a1-\\uffff]{2,}))" + // Allow intranet sites (no TLD) if `allowLocal` is true
            (allowLocal ? "?" : "") + ")(?::\\d{2,5})?(?:/[^\\s]*)?$", "i");
            return { valid: urlExp.test(input.value) };
          }
        };
      }
      cjs.uri = uri;
      return cjs;
    }
    if (false) {
      lib.exports = requireIndex_min();
    } else {
      lib.exports = requireCjs();
    }
    var libExports = lib.exports;
    var plugins = {
      Alias: libExports$A.Alias,
      Aria: libExports$z.Aria,
      Declarative: libExports$y.Declarative,
      DefaultSubmit: libExports$x.DefaultSubmit,
      Dependency: libExports$w.Dependency,
      Excluded: libExports$v.Excluded,
      FieldStatus: libExports$u.FieldStatus,
      Framework: libExports$s.Framework,
      Icon: libExports$r.Icon,
      Message: libExports$t.Message,
      Sequence: libExports$q.Sequence,
      SubmitButton: libExports$p.SubmitButton,
      Tooltip: libExports$o.Tooltip,
      Trigger: libExports$n.Trigger
    };
    var validators = {
      between: libExports$m.between,
      blank: libExports$l.blank,
      callback: libExports$k.callback,
      choice: libExports$j.choice,
      creditCard: libExports$i.creditCard,
      date: libExports$h.date,
      different: libExports$g.different,
      digits: libExports$f.digits,
      emailAddress: libExports$e.emailAddress,
      file: libExports$d.file,
      greaterThan: libExports$c.greaterThan,
      identical: libExports$b.identical,
      integer: libExports$a.integer,
      ip: libExports$9.ip,
      lessThan: libExports$8.lessThan,
      notEmpty: libExports$7.notEmpty,
      numeric: libExports$6.numeric,
      promise: libExports$5.promise,
      regexp: libExports$4.regexp,
      remote: libExports$3.remote,
      stringCase: libExports$2.stringCase,
      stringLength: libExports$1.stringLength,
      uri: libExports.uri
    };
    var formValidationWithPopularValidators = function(form, options) {
      var instance = libExports$B.formValidation(form, options);
      Object.keys(validators).forEach(function(name) {
        return instance.registerValidator(name, validators[name]);
      });
      return instance;
    };
    exports.Plugin = libExports$B.Plugin;
    exports.algorithms = libExports$B.algorithms;
    exports.formValidation = formValidationWithPopularValidators;
    exports.plugins = plugins;
    exports.utils = libExports$B.utils;
    exports.validators = validators;
  }
});

// node_modules/@form-validation/bundle/lib/popular.js
var require_popular2 = __commonJS({
  "node_modules/@form-validation/bundle/lib/popular.js"(exports, module) {
    if (false) {
      module.exports = null;
    } else {
      module.exports = require_popular();
    }
  }
});
export default require_popular2();
/*! Bundled license information:

@form-validation/bundle/lib/cjs/popular.js:
  (** 
   * FormValidation (https://formvalidation.io)
   * The best validation library for JavaScript
   * (c) 2013 - 2023 Nguyen Huu Phuoc <me@phuoc.ng>
   *
   * @license https://formvalidation.io/license
   * @package @form-validation/core
   * @version 2.4.0
   *)
  (** 
   * FormValidation (https://formvalidation.io)
   * The best validation library for JavaScript
   * (c) 2013 - 2023 Nguyen Huu Phuoc <me@phuoc.ng>
   *
   * @license https://formvalidation.io/license
   * @package @form-validation/plugin-alias
   * @version 2.4.0
   *)
  (** 
   * FormValidation (https://formvalidation.io)
   * The best validation library for JavaScript
   * (c) 2013 - 2023 Nguyen Huu Phuoc <me@phuoc.ng>
   *
   * @license https://formvalidation.io/license
   * @package @form-validation/plugin-aria
   * @version 2.4.0
   *)
  (** 
   * FormValidation (https://formvalidation.io)
   * The best validation library for JavaScript
   * (c) 2013 - 2023 Nguyen Huu Phuoc <me@phuoc.ng>
   *
   * @license https://formvalidation.io/license
   * @package @form-validation/plugin-declarative
   * @version 2.4.0
   *)
  (** 
   * FormValidation (https://formvalidation.io)
   * The best validation library for JavaScript
   * (c) 2013 - 2023 Nguyen Huu Phuoc <me@phuoc.ng>
   *
   * @license https://formvalidation.io/license
   * @package @form-validation/plugin-default-submit
   * @version 2.4.0
   *)
  (** 
   * FormValidation (https://formvalidation.io)
   * The best validation library for JavaScript
   * (c) 2013 - 2023 Nguyen Huu Phuoc <me@phuoc.ng>
   *
   * @license https://formvalidation.io/license
   * @package @form-validation/plugin-dependency
   * @version 2.4.0
   *)
  (** 
   * FormValidation (https://formvalidation.io)
   * The best validation library for JavaScript
   * (c) 2013 - 2023 Nguyen Huu Phuoc <me@phuoc.ng>
   *
   * @license https://formvalidation.io/license
   * @package @form-validation/plugin-excluded
   * @version 2.4.0
   *)
  (** 
   * FormValidation (https://formvalidation.io)
   * The best validation library for JavaScript
   * (c) 2013 - 2023 Nguyen Huu Phuoc <me@phuoc.ng>
   *
   * @license https://formvalidation.io/license
   * @package @form-validation/plugin-field-status
   * @version 2.4.0
   *)
  (** 
   * FormValidation (https://formvalidation.io)
   * The best validation library for JavaScript
   * (c) 2013 - 2023 Nguyen Huu Phuoc <me@phuoc.ng>
   *
   * @license https://formvalidation.io/license
   * @package @form-validation/plugin-message
   * @version 2.4.0
   *)
  (** 
   * FormValidation (https://formvalidation.io)
   * The best validation library for JavaScript
   * (c) 2013 - 2023 Nguyen Huu Phuoc <me@phuoc.ng>
   *
   * @license https://formvalidation.io/license
   * @package @form-validation/plugin-framework
   * @version 2.4.0
   *)
  (** 
   * FormValidation (https://formvalidation.io)
   * The best validation library for JavaScript
   * (c) 2013 - 2023 Nguyen Huu Phuoc <me@phuoc.ng>
   *
   * @license https://formvalidation.io/license
   * @package @form-validation/plugin-icon
   * @version 2.4.0
   *)
  (** 
   * FormValidation (https://formvalidation.io)
   * The best validation library for JavaScript
   * (c) 2013 - 2023 Nguyen Huu Phuoc <me@phuoc.ng>
   *
   * @license https://formvalidation.io/license
   * @package @form-validation/plugin-sequence
   * @version 2.4.0
   *)
  (** 
   * FormValidation (https://formvalidation.io)
   * The best validation library for JavaScript
   * (c) 2013 - 2023 Nguyen Huu Phuoc <me@phuoc.ng>
   *
   * @license https://formvalidation.io/license
   * @package @form-validation/plugin-submit-button
   * @version 2.4.0
   *)
  (** 
   * FormValidation (https://formvalidation.io)
   * The best validation library for JavaScript
   * (c) 2013 - 2023 Nguyen Huu Phuoc <me@phuoc.ng>
   *
   * @license https://formvalidation.io/license
   * @package @form-validation/plugin-tooltip
   * @version 2.4.0
   *)
  (** 
   * FormValidation (https://formvalidation.io)
   * The best validation library for JavaScript
   * (c) 2013 - 2023 Nguyen Huu Phuoc <me@phuoc.ng>
   *
   * @license https://formvalidation.io/license
   * @package @form-validation/plugin-trigger
   * @version 2.4.0
   *)
  (** 
   * FormValidation (https://formvalidation.io)
   * The best validation library for JavaScript
   * (c) 2013 - 2023 Nguyen Huu Phuoc <me@phuoc.ng>
   *
   * @license https://formvalidation.io/license
   * @package @form-validation/validator-between
   * @version 2.4.0
   *)
  (** 
   * FormValidation (https://formvalidation.io)
   * The best validation library for JavaScript
   * (c) 2013 - 2023 Nguyen Huu Phuoc <me@phuoc.ng>
   *
   * @license https://formvalidation.io/license
   * @package @form-validation/validator-blank
   * @version 2.4.0
   *)
  (** 
   * FormValidation (https://formvalidation.io)
   * The best validation library for JavaScript
   * (c) 2013 - 2023 Nguyen Huu Phuoc <me@phuoc.ng>
   *
   * @license https://formvalidation.io/license
   * @package @form-validation/validator-callback
   * @version 2.4.0
   *)
  (** 
   * FormValidation (https://formvalidation.io)
   * The best validation library for JavaScript
   * (c) 2013 - 2023 Nguyen Huu Phuoc <me@phuoc.ng>
   *
   * @license https://formvalidation.io/license
   * @package @form-validation/validator-choice
   * @version 2.4.0
   *)
  (** 
   * FormValidation (https://formvalidation.io)
   * The best validation library for JavaScript
   * (c) 2013 - 2023 Nguyen Huu Phuoc <me@phuoc.ng>
   *
   * @license https://formvalidation.io/license
   * @package @form-validation/validator-credit-card
   * @version 2.4.0
   *)
  (** 
   * FormValidation (https://formvalidation.io)
   * The best validation library for JavaScript
   * (c) 2013 - 2023 Nguyen Huu Phuoc <me@phuoc.ng>
   *
   * @license https://formvalidation.io/license
   * @package @form-validation/validator-date
   * @version 2.4.0
   *)
  (** 
   * FormValidation (https://formvalidation.io)
   * The best validation library for JavaScript
   * (c) 2013 - 2023 Nguyen Huu Phuoc <me@phuoc.ng>
   *
   * @license https://formvalidation.io/license
   * @package @form-validation/validator-different
   * @version 2.4.0
   *)
  (** 
   * FormValidation (https://formvalidation.io)
   * The best validation library for JavaScript
   * (c) 2013 - 2023 Nguyen Huu Phuoc <me@phuoc.ng>
   *
   * @license https://formvalidation.io/license
   * @package @form-validation/validator-digits
   * @version 2.4.0
   *)
  (** 
   * FormValidation (https://formvalidation.io)
   * The best validation library for JavaScript
   * (c) 2013 - 2023 Nguyen Huu Phuoc <me@phuoc.ng>
   *
   * @license https://formvalidation.io/license
   * @package @form-validation/validator-email-address
   * @version 2.4.0
   *)
  (** 
   * FormValidation (https://formvalidation.io)
   * The best validation library for JavaScript
   * (c) 2013 - 2023 Nguyen Huu Phuoc <me@phuoc.ng>
   *
   * @license https://formvalidation.io/license
   * @package @form-validation/validator-file
   * @version 2.4.0
   *)
  (** 
   * FormValidation (https://formvalidation.io)
   * The best validation library for JavaScript
   * (c) 2013 - 2023 Nguyen Huu Phuoc <me@phuoc.ng>
   *
   * @license https://formvalidation.io/license
   * @package @form-validation/validator-greater-than
   * @version 2.4.0
   *)
  (** 
   * FormValidation (https://formvalidation.io)
   * The best validation library for JavaScript
   * (c) 2013 - 2023 Nguyen Huu Phuoc <me@phuoc.ng>
   *
   * @license https://formvalidation.io/license
   * @package @form-validation/validator-identical
   * @version 2.4.0
   *)
  (** 
   * FormValidation (https://formvalidation.io)
   * The best validation library for JavaScript
   * (c) 2013 - 2023 Nguyen Huu Phuoc <me@phuoc.ng>
   *
   * @license https://formvalidation.io/license
   * @package @form-validation/validator-integer
   * @version 2.4.0
   *)
  (** 
   * FormValidation (https://formvalidation.io)
   * The best validation library for JavaScript
   * (c) 2013 - 2023 Nguyen Huu Phuoc <me@phuoc.ng>
   *
   * @license https://formvalidation.io/license
   * @package @form-validation/validator-ip
   * @version 2.4.0
   *)
  (** 
   * FormValidation (https://formvalidation.io)
   * The best validation library for JavaScript
   * (c) 2013 - 2023 Nguyen Huu Phuoc <me@phuoc.ng>
   *
   * @license https://formvalidation.io/license
   * @package @form-validation/validator-less-than
   * @version 2.4.0
   *)
  (** 
   * FormValidation (https://formvalidation.io)
   * The best validation library for JavaScript
   * (c) 2013 - 2023 Nguyen Huu Phuoc <me@phuoc.ng>
   *
   * @license https://formvalidation.io/license
   * @package @form-validation/validator-not-empty
   * @version 2.4.0
   *)
  (** 
   * FormValidation (https://formvalidation.io)
   * The best validation library for JavaScript
   * (c) 2013 - 2023 Nguyen Huu Phuoc <me@phuoc.ng>
   *
   * @license https://formvalidation.io/license
   * @package @form-validation/validator-numeric
   * @version 2.4.0
   *)
  (** 
   * FormValidation (https://formvalidation.io)
   * The best validation library for JavaScript
   * (c) 2013 - 2023 Nguyen Huu Phuoc <me@phuoc.ng>
   *
   * @license https://formvalidation.io/license
   * @package @form-validation/validator-promise
   * @version 2.4.0
   *)
  (** 
   * FormValidation (https://formvalidation.io)
   * The best validation library for JavaScript
   * (c) 2013 - 2023 Nguyen Huu Phuoc <me@phuoc.ng>
   *
   * @license https://formvalidation.io/license
   * @package @form-validation/validator-regexp
   * @version 2.4.0
   *)
  (** 
   * FormValidation (https://formvalidation.io)
   * The best validation library for JavaScript
   * (c) 2013 - 2023 Nguyen Huu Phuoc <me@phuoc.ng>
   *
   * @license https://formvalidation.io/license
   * @package @form-validation/validator-remote
   * @version 2.4.0
   *)
  (** 
   * FormValidation (https://formvalidation.io)
   * The best validation library for JavaScript
   * (c) 2013 - 2023 Nguyen Huu Phuoc <me@phuoc.ng>
   *
   * @license https://formvalidation.io/license
   * @package @form-validation/validator-string-case
   * @version 2.4.0
   *)
  (** 
   * FormValidation (https://formvalidation.io)
   * The best validation library for JavaScript
   * (c) 2013 - 2023 Nguyen Huu Phuoc <me@phuoc.ng>
   *
   * @license https://formvalidation.io/license
   * @package @form-validation/validator-string-length
   * @version 2.4.0
   *)
  (** 
   * FormValidation (https://formvalidation.io)
   * The best validation library for JavaScript
   * (c) 2013 - 2023 Nguyen Huu Phuoc <me@phuoc.ng>
   *
   * @license https://formvalidation.io/license
   * @package @form-validation/validator-uri
   * @version 2.4.0
   *)
*/
//# sourceMappingURL=@form-validation_bundle_popular.js.map
