import {
  dataTables_bootstrap5_default
} from "./chunk-CAYPXQDN.js";
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

// node_modules/datatables.net-fixedheader-bs5/js/fixedHeader.bootstrap5.mjs
var import_jquery2 = __toESM(require_jquery(), 1);

// node_modules/datatables.net-fixedheader/js/dataTables.fixedHeader.mjs
var import_jquery = __toESM(require_jquery(), 1);
init_jquery_dataTables();
var $ = import_jquery.default;
var _instCounter = 0;
var FixedHeader = function(dt, config) {
  if (!(this instanceof FixedHeader)) {
    throw "FixedHeader must be initialised with the 'new' keyword.";
  }
  if (config === true) {
    config = {};
  }
  dt = new jquery_dataTables_default.Api(dt);
  this.c = $.extend(true, {}, FixedHeader.defaults, config);
  this.s = {
    dt,
    position: {
      theadTop: 0,
      tbodyTop: 0,
      tfootTop: 0,
      tfootBottom: 0,
      width: 0,
      left: 0,
      tfootHeight: 0,
      theadHeight: 0,
      windowHeight: $(window).height(),
      visible: true
    },
    headerMode: null,
    footerMode: null,
    autoWidth: dt.settings()[0].oFeatures.bAutoWidth,
    namespace: ".dtfc" + _instCounter++,
    scrollLeft: {
      header: -1,
      footer: -1
    },
    enable: true,
    autoDisable: false
  };
  this.dom = {
    floatingHeader: null,
    thead: $(dt.table().header()),
    tbody: $(dt.table().body()),
    tfoot: $(dt.table().footer()),
    header: {
      host: null,
      floating: null,
      floatingParent: $('<div class="dtfh-floatingparent">'),
      placeholder: null
    },
    footer: {
      host: null,
      floating: null,
      floatingParent: $('<div class="dtfh-floatingparent">'),
      placeholder: null
    }
  };
  this.dom.header.host = this.dom.thead.parent();
  this.dom.footer.host = this.dom.tfoot.parent();
  var dtSettings = dt.settings()[0];
  if (dtSettings._fixedHeader) {
    throw "FixedHeader already initialised on table " + dtSettings.nTable.id;
  }
  dtSettings._fixedHeader = this;
  this._constructor();
};
$.extend(FixedHeader.prototype, {
  /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
   * API methods
   */
  /**
   * Kill off FH and any events
   */
  destroy: function() {
    var dom = this.dom;
    this.s.dt.off(".dtfc");
    $(window).off(this.s.namespace);
    if (dom.header.rightBlocker) {
      dom.header.rightBlocker.remove();
    }
    if (dom.header.leftBlocker) {
      dom.header.leftBlocker.remove();
    }
    if (dom.footer.rightBlocker) {
      dom.footer.rightBlocker.remove();
    }
    if (dom.footer.leftBlocker) {
      dom.footer.leftBlocker.remove();
    }
    if (this.c.header) {
      this._modeChange("in-place", "header", true);
    }
    if (this.c.footer && dom.tfoot.length) {
      this._modeChange("in-place", "footer", true);
    }
  },
  /**
   * Enable / disable the fixed elements
   *
   * @param  {boolean} enable `true` to enable, `false` to disable
   */
  enable: function(enable, update, type) {
    this.s.enable = enable;
    this.s.enableType = type;
    if (update || update === void 0) {
      this._positions();
      this._scroll(true);
    }
  },
  /**
   * Get enabled status
   */
  enabled: function() {
    return this.s.enable;
  },
  /**
   * Set header offset
   *
   * @param  {int} new value for headerOffset
   */
  headerOffset: function(offset) {
    if (offset !== void 0) {
      this.c.headerOffset = offset;
      this.update();
    }
    return this.c.headerOffset;
  },
  /**
   * Set footer offset
   *
   * @param  {int} new value for footerOffset
   */
  footerOffset: function(offset) {
    if (offset !== void 0) {
      this.c.footerOffset = offset;
      this.update();
    }
    return this.c.footerOffset;
  },
  /**
   * Recalculate the position of the fixed elements and force them into place
   */
  update: function(force) {
    var table = this.s.dt.table().node();
    if (!this.s.enable && !this.s.autoDisable) {
      return;
    }
    if ($(table).is(":visible")) {
      this.s.autoDisable = false;
      this.enable(true, false);
    } else {
      this.s.autoDisable = true;
      this.enable(false, false);
    }
    if ($(table).children("thead").length === 0) {
      return;
    }
    this._positions();
    this._scroll(force !== void 0 ? force : true);
  },
  /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
   * Constructor
   */
  /**
   * FixedHeader constructor - adding the required event listeners and
   * simple initialisation
   *
   * @private
   */
  _constructor: function() {
    var that = this;
    var dt = this.s.dt;
    $(window).on("scroll" + this.s.namespace, function() {
      that._scroll();
    }).on(
      "resize" + this.s.namespace,
      jquery_dataTables_default.util.throttle(function() {
        that.s.position.windowHeight = $(window).height();
        that.update();
      }, 50)
    );
    var autoHeader = $(".fh-fixedHeader");
    if (!this.c.headerOffset && autoHeader.length) {
      this.c.headerOffset = autoHeader.outerHeight();
    }
    var autoFooter = $(".fh-fixedFooter");
    if (!this.c.footerOffset && autoFooter.length) {
      this.c.footerOffset = autoFooter.outerHeight();
    }
    dt.on(
      "column-reorder.dt.dtfc column-visibility.dt.dtfc column-sizing.dt.dtfc responsive-display.dt.dtfc",
      function(e, ctx) {
        that.update();
      }
    ).on("draw.dt.dtfc", function(e, ctx) {
      that.update(ctx === dt.settings()[0] ? false : true);
    });
    dt.on("destroy.dtfc", function() {
      that.destroy();
    });
    this._positions();
    this._scroll();
  },
  /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
   * Private methods
   */
  /**
   * Clone a fixed item to act as a place holder for the original element
   * which is moved into a clone of the table element, and moved around the
   * document to give the fixed effect.
   *
   * @param  {string}  item  'header' or 'footer'
   * @param  {boolean} force Force the clone to happen, or allow automatic
   *   decision (reuse existing if available)
   * @private
   */
  _clone: function(item, force) {
    var that = this;
    var dt = this.s.dt;
    var itemDom = this.dom[item];
    var itemElement = item === "header" ? this.dom.thead : this.dom.tfoot;
    if (item === "footer" && this._scrollEnabled()) {
      return;
    }
    if (!force && itemDom.floating) {
      itemDom.floating.removeClass("fixedHeader-floating fixedHeader-locked");
    } else {
      if (itemDom.floating) {
        if (itemDom.placeholder !== null) {
          itemDom.placeholder.remove();
        }
        this._unsize(item);
        itemDom.floating.children().detach();
        itemDom.floating.remove();
      }
      var tableNode = $(dt.table().node());
      var scrollBody = $(tableNode.parent());
      var scrollEnabled = this._scrollEnabled();
      itemDom.floating = $(dt.table().node().cloneNode(false)).attr("aria-hidden", "true").css({
        "table-layout": "fixed",
        top: 0,
        left: 0
      }).removeAttr("id").append(itemElement);
      itemDom.floatingParent.css({
        width: scrollBody.width(),
        overflow: "hidden",
        height: "fit-content",
        position: "fixed",
        left: scrollEnabled ? tableNode.offset().left + scrollBody.scrollLeft() : 0
      }).css(
        item === "header" ? {
          top: this.c.headerOffset,
          bottom: ""
        } : {
          top: "",
          bottom: this.c.footerOffset
        }
      ).addClass(item === "footer" ? "dtfh-floatingparentfoot" : "dtfh-floatingparenthead").append(itemDom.floating).appendTo("body");
      this._stickyPosition(itemDom.floating, "-");
      var scrollLeftUpdate = function() {
        var scrollLeft = scrollBody.scrollLeft();
        that.s.scrollLeft = { footer: scrollLeft, header: scrollLeft };
        itemDom.floatingParent.scrollLeft(that.s.scrollLeft.header);
      };
      scrollLeftUpdate();
      scrollBody.off("scroll.dtfh").on("scroll.dtfh", scrollLeftUpdate);
      itemDom.placeholder = itemElement.clone(false);
      itemDom.placeholder.find("*[id]").removeAttr("id");
      itemDom.host.prepend(itemDom.placeholder);
      this._matchWidths(itemDom.placeholder, itemDom.floating);
    }
  },
  /**
   * This method sets the sticky position of the header elements to match fixed columns
   * @param {JQuery<HTMLElement>} el
   * @param {string} sign
   */
  _stickyPosition: function(el, sign) {
    if (this._scrollEnabled()) {
      var that = this;
      var rtl = $(that.s.dt.table().node()).css("direction") === "rtl";
      el.find("th").each(function() {
        if ($(this).css("position") === "sticky") {
          var right = $(this).css("right");
          var left = $(this).css("left");
          if (right !== "auto" && !rtl) {
            var potential = +right.replace(/px/g, "") + (sign === "-" ? -1 : 1) * that.s.dt.settings()[0].oBrowser.barWidth;
            $(this).css("right", potential > 0 ? potential : 0);
          } else if (left !== "auto" && rtl) {
            var potential = +left.replace(/px/g, "") + (sign === "-" ? -1 : 1) * that.s.dt.settings()[0].oBrowser.barWidth;
            $(this).css("left", potential > 0 ? potential : 0);
          }
        }
      });
    }
  },
  /**
   * Copy widths from the cells in one element to another. This is required
   * for the footer as the footer in the main table takes its sizes from the
   * header columns. That isn't present in the footer so to have it still
   * align correctly, the sizes need to be copied over. It is also required
   * for the header when auto width is not enabled
   *
   * @param  {jQuery} from Copy widths from
   * @param  {jQuery} to   Copy widths to
   * @private
   */
  _matchWidths: function(from, to) {
    var get = function(name) {
      return $(name, from).map(function() {
        return $(this).css("width").replace(/[^\d\.]/g, "") * 1;
      }).toArray();
    };
    var set = function(name, toWidths) {
      $(name, to).each(function(i) {
        $(this).css({
          width: toWidths[i],
          minWidth: toWidths[i]
        });
      });
    };
    var thWidths = get("th");
    var tdWidths = get("td");
    set("th", thWidths);
    set("td", tdWidths);
  },
  /**
   * Remove assigned widths from the cells in an element. This is required
   * when inserting the footer back into the main table so the size is defined
   * by the header columns and also when auto width is disabled in the
   * DataTable.
   *
   * @param  {string} item The `header` or `footer`
   * @private
   */
  _unsize: function(item) {
    var el = this.dom[item].floating;
    if (el && (item === "footer" || item === "header" && !this.s.autoWidth)) {
      $("th, td", el).css({
        width: "",
        minWidth: ""
      });
    } else if (el && item === "header") {
      $("th, td", el).css("min-width", "");
    }
  },
  /**
   * Reposition the floating elements to take account of horizontal page
   * scroll
   *
   * @param  {string} item       The `header` or `footer`
   * @param  {int}    scrollLeft Document scrollLeft
   * @private
   */
  _horizontal: function(item, scrollLeft) {
    var itemDom = this.dom[item];
    var position = this.s.position;
    var lastScrollLeft = this.s.scrollLeft;
    if (itemDom.floating && lastScrollLeft[item] !== scrollLeft) {
      if (this._scrollEnabled()) {
        var newScrollLeft = $($(this.s.dt.table().node()).parent()).scrollLeft();
        itemDom.floating.scrollLeft(newScrollLeft);
        itemDom.floatingParent.scrollLeft(newScrollLeft);
      }
      lastScrollLeft[item] = scrollLeft;
    }
  },
  /**
   * Change from one display mode to another. Each fixed item can be in one
   * of:
   *
   * * `in-place` - In the main DataTable
   * * `in` - Floating over the DataTable
   * * `below` - (Header only) Fixed to the bottom of the table body
   * * `above` - (Footer only) Fixed to the top of the table body
   *
   * @param  {string}  mode        Mode that the item should be shown in
   * @param  {string}  item        'header' or 'footer'
   * @param  {boolean} forceChange Force a redraw of the mode, even if already
   *     in that mode.
   * @private
   */
  _modeChange: function(mode, item, forceChange) {
    var dt = this.s.dt;
    var itemDom = this.dom[item];
    var position = this.s.position;
    var scrollEnabled = this._scrollEnabled();
    if (item === "footer" && scrollEnabled) {
      return;
    }
    var importantWidth = function(w) {
      itemDom.floating.attr("style", function(i, s) {
        return (s || "") + "width: " + w + "px !important;";
      });
      if (!scrollEnabled) {
        itemDom.floatingParent.attr("style", function(i, s) {
          return (s || "") + "width: " + w + "px !important;";
        });
      }
    };
    var tablePart = this.dom[item === "footer" ? "tfoot" : "thead"];
    var focus = $.contains(tablePart[0], document.activeElement) ? document.activeElement : null;
    var scrollBody = $($(this.s.dt.table().node()).parent());
    if (mode === "in-place") {
      if (itemDom.placeholder) {
        itemDom.placeholder.remove();
        itemDom.placeholder = null;
      }
      this._unsize(item);
      if (item === "header") {
        itemDom.host.prepend(tablePart);
      } else {
        itemDom.host.append(tablePart);
      }
      if (itemDom.floating) {
        itemDom.floating.remove();
        itemDom.floating = null;
        this._stickyPosition(itemDom.host, "+");
      }
      if (itemDom.floatingParent) {
        itemDom.floatingParent.remove();
      }
      $($(itemDom.host.parent()).parent()).scrollLeft(scrollBody.scrollLeft());
    } else if (mode === "in") {
      this._clone(item, forceChange);
      var scrollOffset = scrollBody.offset();
      var windowTop = $(document).scrollTop();
      var windowHeight = $(window).height();
      var windowBottom = windowTop + windowHeight;
      var bodyTop = scrollEnabled ? scrollOffset.top : position.tbodyTop;
      var bodyBottom = scrollEnabled ? scrollOffset.top + scrollBody.outerHeight() : position.tfootTop;
      var shuffle = item === "footer" ? (
        // footer and top of body isn't on screen
        bodyTop > windowBottom ? (
          // Yes - push the footer below
          position.tfootHeight
        ) : (
          // No - bottom set to the gap between the top of the body and the bottom of the window
          bodyTop + position.tfootHeight - windowBottom
        )
      ) : (
        // Otherwise must be a header so get the difference from the bottom of the
        //  desired floating header and the bottom of the table body
        windowTop + this.c.headerOffset + position.theadHeight - bodyBottom
      );
      var prop = item === "header" ? "top" : "bottom";
      var val = this.c[item + "Offset"] - (shuffle > 0 ? shuffle : 0);
      itemDom.floating.addClass("fixedHeader-floating");
      itemDom.floatingParent.css(prop, val).css({
        left: position.left,
        height: item === "header" ? position.theadHeight : position.tfootHeight,
        "z-index": 2
      }).append(itemDom.floating);
      importantWidth(position.width);
      if (item === "footer") {
        itemDom.floating.css("top", "");
      }
    } else if (mode === "below") {
      this._clone(item, forceChange);
      itemDom.floating.addClass("fixedHeader-locked");
      itemDom.floatingParent.css({
        position: "absolute",
        top: position.tfootTop - position.theadHeight,
        left: position.left + "px"
      });
      importantWidth(position.width);
    } else if (mode === "above") {
      this._clone(item, forceChange);
      itemDom.floating.addClass("fixedHeader-locked");
      itemDom.floatingParent.css({
        position: "absolute",
        top: position.tbodyTop,
        left: position.left + "px"
      });
      importantWidth(position.width);
    }
    if (focus && focus !== document.activeElement) {
      setTimeout(function() {
        focus.focus();
      }, 10);
    }
    this.s.scrollLeft.header = -1;
    this.s.scrollLeft.footer = -1;
    this.s[item + "Mode"] = mode;
  },
  /**
   * Cache the positional information that is required for the mode
   * calculations that FixedHeader performs.
   *
   * @private
   */
  _positions: function() {
    var dt = this.s.dt;
    var table = dt.table();
    var position = this.s.position;
    var dom = this.dom;
    var tableNode = $(table.node());
    var scrollEnabled = this._scrollEnabled();
    var thead = $(dt.table().header());
    var tfoot = $(dt.table().footer());
    var tbody = dom.tbody;
    var scrollBody = tableNode.parent();
    position.visible = tableNode.is(":visible");
    position.width = tableNode.outerWidth();
    position.left = tableNode.offset().left;
    position.theadTop = thead.offset().top;
    position.tbodyTop = scrollEnabled ? scrollBody.offset().top : tbody.offset().top;
    position.tbodyHeight = scrollEnabled ? scrollBody.outerHeight() : tbody.outerHeight();
    position.theadHeight = thead.outerHeight();
    position.theadBottom = position.theadTop + position.theadHeight;
    if (tfoot.length) {
      position.tfootTop = position.tbodyTop + position.tbodyHeight;
      position.tfootBottom = position.tfootTop + tfoot.outerHeight();
      position.tfootHeight = tfoot.outerHeight();
    } else {
      position.tfootTop = position.tbodyTop + tbody.outerHeight();
      position.tfootBottom = position.tfootTop;
      position.tfootHeight = position.tfootTop;
    }
  },
  /**
   * Mode calculation - determine what mode the fixed items should be placed
   * into.
   *
   * @param  {boolean} forceChange Force a redraw of the mode, even if already
   *     in that mode.
   * @private
   */
  _scroll: function(forceChange) {
    if (this.s.dt.settings()[0].bDestroying) {
      return;
    }
    var scrollEnabled = this._scrollEnabled();
    var scrollBody = $(this.s.dt.table().node()).parent();
    var scrollOffset = scrollBody.offset();
    var scrollHeight = scrollBody.outerHeight();
    var windowLeft = $(document).scrollLeft();
    var windowTop = $(document).scrollTop();
    var windowHeight = $(window).height();
    var windowBottom = windowHeight + windowTop;
    var position = this.s.position;
    var headerMode, footerMode;
    var bodyTop = scrollEnabled ? scrollOffset.top : position.tbodyTop;
    var bodyLeft = scrollEnabled ? scrollOffset.left : position.left;
    var bodyBottom = scrollEnabled ? scrollOffset.top + scrollHeight : position.tfootTop;
    var bodyWidth = scrollEnabled ? scrollBody.outerWidth() : position.tbodyWidth;
    var windowBottom = windowTop + windowHeight;
    if (this.c.header) {
      if (!this.s.enable) {
        headerMode = "in-place";
      } else if (!position.visible || windowTop + this.c.headerOffset + position.theadHeight <= bodyTop) {
        headerMode = "in-place";
      } else if (
        // The scrolling plus the header offset plus the height of the header is lower than the top of the body
        windowTop + this.c.headerOffset + position.theadHeight > bodyTop && // And the scrolling at the top plus the header offset is above the bottom of the body
        windowTop + this.c.headerOffset + position.theadHeight < bodyBottom
      ) {
        headerMode = "in";
        var scrollBody = $($(this.s.dt.table().node()).parent());
        if (windowTop + this.c.headerOffset + position.theadHeight > bodyBottom || this.dom.header.floatingParent === void 0) {
          forceChange = true;
        } else {
          this.dom.header.floatingParent.css({
            top: this.c.headerOffset,
            position: "fixed"
          }).append(this.dom.header.floating);
        }
      } else {
        headerMode = "below";
      }
      if (forceChange || headerMode !== this.s.headerMode) {
        this._modeChange(headerMode, "header", forceChange);
      }
      this._horizontal("header", windowLeft);
    }
    var header = {
      offset: { top: 0, left: 0 },
      height: 0
    };
    var footer = {
      offset: { top: 0, left: 0 },
      height: 0
    };
    if (this.c.footer && this.dom.tfoot.length) {
      if (!this.s.enable) {
        footerMode = "in-place";
      } else if (!position.visible || position.tfootBottom + this.c.footerOffset <= windowBottom) {
        footerMode = "in-place";
      } else if (bodyBottom + position.tfootHeight + this.c.footerOffset > windowBottom && bodyTop + this.c.footerOffset < windowBottom) {
        footerMode = "in";
        forceChange = true;
      } else {
        footerMode = "above";
      }
      if (forceChange || footerMode !== this.s.footerMode) {
        this._modeChange(footerMode, "footer", forceChange);
      }
      this._horizontal("footer", windowLeft);
      var getOffsetHeight = function(el) {
        return {
          offset: el.offset(),
          height: el.outerHeight()
        };
      };
      header = this.dom.header.floating ? getOffsetHeight(this.dom.header.floating) : getOffsetHeight(this.dom.thead);
      footer = this.dom.footer.floating ? getOffsetHeight(this.dom.footer.floating) : getOffsetHeight(this.dom.tfoot);
      if (scrollEnabled && footer.offset.top > windowTop) {
        var overlap = windowTop - scrollOffset.top;
        var newHeight = windowBottom + // If the gap between the top of the scrollbody and the window is more than
        //  the height of the header then the top of the table is still visible so add that gap
        // Doing this has effectively calculated the height from the top of the table to the bottom of the current page
        (overlap > -header.height ? overlap : 0) - // Take from that
        // The top of the header plus
        (header.offset.top + // The header height if the standard header is present
        (overlap < -header.height ? header.height : 0) + // And the height of the footer
        footer.height);
        if (newHeight < 0) {
          newHeight = 0;
        }
        scrollBody.outerHeight(newHeight);
        if (Math.round(scrollBody.outerHeight()) >= Math.round(newHeight)) {
          $(this.dom.tfoot.parent()).addClass("fixedHeader-floating");
        } else {
          $(this.dom.tfoot.parent()).removeClass("fixedHeader-floating");
        }
      }
    }
    if (this.dom.header.floating) {
      this.dom.header.floatingParent.css("left", bodyLeft - windowLeft);
    }
    if (this.dom.footer.floating) {
      this.dom.footer.floatingParent.css("left", bodyLeft - windowLeft);
    }
    if (this.s.dt.settings()[0]._fixedColumns !== void 0) {
      var adjustBlocker = function(side, end, el) {
        if (el === void 0) {
          var blocker = $("div.dtfc-" + side + "-" + end + "-blocker");
          el = blocker.length === 0 ? null : blocker.clone().css("z-index", 1);
        }
        if (el !== null) {
          if (headerMode === "in" || headerMode === "below") {
            el.appendTo("body").css({
              top: end === "top" ? header.offset.top : footer.offset.top,
              left: side === "right" ? bodyLeft + bodyWidth - el.width() : bodyLeft
            });
          } else {
            el.detach();
          }
        }
        return el;
      };
      this.dom.header.rightBlocker = adjustBlocker(
        "right",
        "top",
        this.dom.header.rightBlocker
      );
      this.dom.header.leftBlocker = adjustBlocker("left", "top", this.dom.header.leftBlocker);
      this.dom.footer.rightBlocker = adjustBlocker(
        "right",
        "bottom",
        this.dom.footer.rightBlocker
      );
      this.dom.footer.leftBlocker = adjustBlocker(
        "left",
        "bottom",
        this.dom.footer.leftBlocker
      );
    }
  },
  /**
   * Function to check if scrolling is enabled on the table or not
   * @returns Boolean value indicating if scrolling on the table is enabled or not
   */
  _scrollEnabled: function() {
    var oScroll = this.s.dt.settings()[0].oScroll;
    if (oScroll.sY !== "" || oScroll.sX !== "") {
      return true;
    }
    return false;
  }
});
FixedHeader.version = "3.4.0";
FixedHeader.defaults = {
  header: true,
  footer: false,
  headerOffset: 0,
  footerOffset: 0
};
$.fn.dataTable.FixedHeader = FixedHeader;
$.fn.DataTable.FixedHeader = FixedHeader;
$(document).on("init.dt.dtfh", function(e, settings, json) {
  if (e.namespace !== "dt") {
    return;
  }
  var init = settings.oInit.fixedHeader;
  var defaults = jquery_dataTables_default.defaults.fixedHeader;
  if ((init || defaults) && !settings._fixedHeader) {
    var opts = $.extend({}, defaults, init);
    if (init !== false) {
      new FixedHeader(settings, opts);
    }
  }
});
jquery_dataTables_default.Api.register("fixedHeader()", function() {
});
jquery_dataTables_default.Api.register("fixedHeader.adjust()", function() {
  return this.iterator("table", function(ctx) {
    var fh = ctx._fixedHeader;
    if (fh) {
      fh.update();
    }
  });
});
jquery_dataTables_default.Api.register("fixedHeader.enable()", function(flag) {
  return this.iterator("table", function(ctx) {
    var fh = ctx._fixedHeader;
    flag = flag !== void 0 ? flag : true;
    if (fh && flag !== fh.enabled()) {
      fh.enable(flag);
    }
  });
});
jquery_dataTables_default.Api.register("fixedHeader.enabled()", function() {
  if (this.context.length) {
    var fh = this.context[0]._fixedHeader;
    if (fh) {
      return fh.enabled();
    }
  }
  return false;
});
jquery_dataTables_default.Api.register("fixedHeader.disable()", function() {
  return this.iterator("table", function(ctx) {
    var fh = ctx._fixedHeader;
    if (fh && fh.enabled()) {
      fh.enable(false);
    }
  });
});
$.each(["header", "footer"], function(i, el) {
  jquery_dataTables_default.Api.register("fixedHeader." + el + "Offset()", function(offset) {
    var ctx = this.context;
    if (offset === void 0) {
      return ctx.length && ctx[0]._fixedHeader ? ctx[0]._fixedHeader[el + "Offset"]() : void 0;
    }
    return this.iterator("table", function(ctx2) {
      var fh = ctx2._fixedHeader;
      if (fh) {
        fh[el + "Offset"](offset);
      }
    });
  });
});

// node_modules/datatables.net-fixedheader-bs5/js/fixedHeader.bootstrap5.mjs
var fixedHeader_bootstrap5_default = dataTables_bootstrap5_default;
export {
  fixedHeader_bootstrap5_default as default
};
/*! Bundled license information:

datatables.net-fixedheader/js/dataTables.fixedHeader.mjs:
  (*! FixedHeader 3.4.0
   * © SpryMedia Ltd - datatables.net/license
   *)

datatables.net-fixedheader-bs5/js/fixedHeader.bootstrap5.mjs:
  (*! Bootstrap 5 styling wrapper for FixedHeader
   * © SpryMedia Ltd - datatables.net/license
   *)
*/
//# sourceMappingURL=datatables__net-fixedheader-bs5.js.map
