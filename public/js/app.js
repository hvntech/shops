/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;
/******/
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// identity function for calling harmony imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__instant_filter__ = __webpack_require__(2);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__item_selector__ = __webpack_require__(7);



window.Soccast = window.Soccast || {};

jQuery(document).ready(function () {
  if (Soccast.searchList) {
    new __WEBPACK_IMPORTED_MODULE_0__instant_filter__["a" /* default */](Soccast);
  }

  new __WEBPACK_IMPORTED_MODULE_1__item_selector__["a" /* default */]();

  $('#logout').on('click', function (e) {
    e.preventDefault();
    if (confirm('Do you want to logout ?')) {
      window.location = e.target.href;
    }
  });
});

/***/ }),
/* 1 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),
/* 2 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var InstantFilter = function () {
  function InstantFilter(Soccast) {
    _classCallCheck(this, InstantFilter);

    this.Soccast = Soccast;

    this.init();
  }

  _createClass(InstantFilter, [{
    key: 'init',
    value: function init() {
      this.currentPage = this.Soccast.currentPage;
      this.requestTimer = null;
      this.isLoading = false;

      this.$fields = $('[data-field]');
      this.$sortColumns = $('[data-sort]');

      // Fill search fields with old data
      this.fillFields();

      this.handleEvents();

      this.request();
    }
  }, {
    key: 'fillFields',
    value: function fillFields() {
      // Fill out search fields
      var fieldValues = this.Soccast.fields;
      if ($.isPlainObject(fieldValues)) {
        this.$fields.each(function (index, input) {
          var $input = $(input);

          if (typeof fieldValues[$input.data('field')] !== 'undefined') {
            $input.val(fieldValues[$input.data('field')]);
          }
        });
      }

      // Fill out sort columns
      var sorts = this.Soccast.sorts;

      // Reset existing sort if multipleSort is enabled
      if (!$.isEmptyObject(sorts) && this.Soccast.multipleSort !== true) {
        this.$sortColumns.each(function (index, column) {
          return $(column).data('direction', null);
        });
      }

      if ($.isPlainObject(sorts)) {
        this.$sortColumns.each(function (index, column) {
          var $column = $(column);

          if (typeof sorts[$column.data('sort')] !== 'undefined') {
            $column.data('direction', sorts[$column.data('sort')]);
          }
        });
      }

      this.updateSortColumns();
    }
  }, {
    key: 'handleEvents',
    value: function handleEvents() {
      var _this = this;

      // Handle search field change
      this.$fields.on('keyup change', function (evt) {
        var $this = $(evt.target);

        if ($this.data('oldValue') === $this.val()) {
          return true;
        }

        $this.data('oldValue', $this.val());

        clearTimeout(_this.requestTimer);

        _this.requestTimer = setTimeout(function () {
          return _this.request();
        }, 300);
      });

      // Handle click on pagination
      $('#pagination').on('click', '[data-page]', function (evt) {
        evt.preventDefault();

        _this.currentPage = $(evt.target).data('page');

        _this.request();
      });

      // Handle sort
      this.$sortColumns.on('click', function (evt) {
        evt.preventDefault();

        var $column = $(evt.target).closest('th');
        var direction = $column.data('direction');

        if (_this.Soccast.multipleSort !== true) {
          _this.$sortColumns.each(function (index, column) {
            return $(column).data('direction', null);
          });
        }

        if (!direction || 'desc' === direction) {
          direction = 'asc';
        } else {
          direction = 'desc';
        }

        $column.data('direction', direction);

        _this.updateSortColumns();

        _this.request();
      });
    }
  }, {
    key: 'request',
    value: function request(params) {
      var _this2 = this;

      if (this.isLoading) {
        return;
      }

      params = params || this.prepareParams();

      this.isLoading = true;
      $('.template-wrapper').addClass('loading');

      $.ajax({
        url: this.Soccast.searchUrl,
        method: 'GET',
        data: params,
        success: function success(response) {
          for (var template in response.templates) {
            $('#' + template).html(response.templates[template]);
          }

          history.pushState(null, null, response.url);

          $('body').trigger('listLoaded', _this2.currentPage);
        },
        complete: function complete() {
          _this2.isLoading = false;
          $('.template-wrapper').removeClass('loading');
        },
        error: function error() {
          //@todo: show alert when error occurs
        }
      });
    }
  }, {
    key: 'prepareParams',
    value: function prepareParams() {
      var params = {
        fields: {},
        sorts: {},
        page: this.currentPage
      };

      // Generate search fields from inputs
      this.$fields.each(function (index, input) {
        var $input = $(input);

        params.fields[$input.data('field')] = $input.val();
      });

      // Generate sort columns
      this.$sortColumns.each(function (index, column) {
        var $column = $(column);

        if ($column.data('direction')) {
          params.sorts[$column.data('sort')] = $column.data('direction');
        }
      });

      return params;
    }

    /**
     * Update UI of columns to display current direction
     */

  }, {
    key: 'updateSortColumns',
    value: function updateSortColumns() {
      this.$sortColumns.each(function (index, column) {
        var $column = $(column);
        var sort = $column.data('sort');
        var direction = $column.data('direction');

        $column.removeClass('sort-none sort-asc sort-desc');

        if ('asc' === direction) {
          $column.addClass('sort-asc');
        } else if ('desc' === direction) {
          $column.addClass('sort-desc');
        } else {
          $column.addClass('sort-none');
        }
      });
    }
  }]);

  return InstantFilter;
}();

/* harmony default export */ __webpack_exports__["a"] = (InstantFilter);

/***/ }),
/* 3 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(0);
module.exports = __webpack_require__(1);


/***/ }),
/* 4 */,
/* 5 */,
/* 6 */,
/* 7 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var ItemSelector = function () {
  function ItemSelector() {
    _classCallCheck(this, ItemSelector);

    this.selectedItems = [];

    this.init();
  }

  _createClass(ItemSelector, [{
    key: 'init',
    value: function init() {
      this.handleCheckboxClick = this.handleCheckboxClick.bind(this);
      $('table').on('click', 'input[type="checkbox"]', this.handleCheckboxClick);

      this.handleLoadPage = this.handleLoadPage.bind(this);
      $('body').on('listLoaded', this.handleLoadPage);

      this.handleSelectAll = this.handleSelectAll.bind(this);
      $('#selectAll, #check-all').on('click', this.handleSelectAll);
    }
  }, {
    key: 'handleCheckboxClick',
    value: function handleCheckboxClick(evt) {
      var id = evt.target.value;

      if (!id || id === 'on') {
        return true;
      }

      this.storeSelectedItems();
      this.selectCheckAll();
    }
  }, {
    key: 'handleSelectAll',
    value: function handleSelectAll(evt) {
      var $target = $(evt.target);

      if ($target.hasClass('checkedAll')) {
        $('input[type="checkbox"]').prop('checked', false);
        $target.removeClass('checkedAll');
      } else {
        $('input[type="checkbox"]').prop('checked', true);
        $target.addClass('checkedAll');
      }

      this.storeSelectedItems();
    }
  }, {
    key: 'handleLoadPage',
    value: function handleLoadPage(evt, page) {
      var _this = this;

      $('table input[type="checkbox"]').each(function (index, el) {
        var $input = $(el);

        if (!$input.val() || $input.val() === 'on') {
          return;
        }

        if (_this.selectedItems.indexOf($input.val()) !== -1) {
          $input.prop('checked', true);
        }
      });

      this.selectCheckAll();
    }
  }, {
    key: 'selectCheckAll',
    value: function selectCheckAll() {
      var checkedAll = true;
      var checkboxLength = $('table input[type="checkbox"]').length;

      $('table input[type="checkbox"]').each(function (index, el) {
        var $input = $(el);

        if (!$input.val() || $input.val() === 'on') {
          checkboxLength--;
          return;
        }

        if (!$input.prop('checked')) {
          checkedAll = false;
        }
      });

      $('#selectAll, #check-all').prop('checked', checkedAll && checkboxLength);
    }
  }, {
    key: 'storeSelectedItems',
    value: function storeSelectedItems() {
      var _this2 = this;

      this.selectedItems = [];

      $('table input[type="checkbox"]:checked').each(function (index, el) {
        var value = $(el).val();

        if (value || value === 'on') {
          _this2.selectedItems.push(value);
        }
      });
    }
  }]);

  return ItemSelector;
}();

/* harmony default export */ __webpack_exports__["a"] = (ItemSelector);

/***/ })
/******/ ]);