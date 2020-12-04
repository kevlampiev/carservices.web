(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[1],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/UI/OrderDetails.vue?vue&type=script&lang=js&":
/*!**************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/UI/OrderDetails.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  data: function data() {
    return {
      orderDetails: {
        user_id: '',
        schedule_id: 1,
        car_model: '',
        license_plate_number: '',
        description: '',
        telephone: '',
        order_status: ''
      }
    };
  },
  props: ['close'],
  computed: {
    order_date: function order_date() {
      return this.$store.state.currentService.selectedSchedule.work_day;
    },
    order_time: function order_time() {
      return Math.trunc(this.$store.state.currentService.selectedSchedule.work_time) + ':' + 60 * (this.$store.state.currentService.selectedSchedule.work_time % 1);
    },
    orderId: function orderId() {
      return this.$store.state.currentService.commonInfo.id;
    },
    serviceName: function serviceName() {
      return 'Пока не сделано';
    },
    userToken: function userToken() {
      return this.$store.state.userData.token;
    }
  },
  methods: {
    sendOrderToServer: function sendOrderToServer() {
      var _this = this;

      axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.userToken;
      axios.post('/api/order', this.orderDetails).then(function (res) {
        console.log(res);

        _this.$store.dispatch('getServiceInfo', {
          id: _this.$store.state.currentService.commonInfo.id
        });
      })["catch"](function (err) {
        console.error(err.message);
      });
      this.close();
    }
  },
  mounted: function mounted() {
    this.orderDetails.schedule_id = this.$store.state.currentService.selectedSchedule.id;
    console.log(this.$store.state.makeOrder.count);
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/UI/OrderDetails.vue?vue&type=template&id=52ef4058&":
/*!******************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/UI/OrderDetails.vue?vue&type=template&id=52ef4058& ***!
  \******************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "company-entry" }, [
    _c("form", { staticClass: "company-entry-form" }, [
      _vm._m(0),
      _vm._v(" "),
      _c("div", { staticClass: "company-entry-block-divider" }),
      _vm._v(" "),
      _c("div", { staticClass: "company-entry-block-wrapper" }, [
        _vm._m(1),
        _vm._v(" "),
        _vm._m(2),
        _vm._v(" "),
        _vm._m(3),
        _vm._v(" "),
        _c(
          "button",
          {
            staticClass: "company-entry-block-button",
            attrs: { id: "company-entry-form-button", type: "button" },
            on: { click: _vm.sendOrderToServer }
          },
          [_vm._v("Оформить запись\n            ")]
        )
      ])
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "company-entry-block-wrapper" }, [
      _c("div", { staticClass: "company-entry-block-row-no-grow" }, [
        _c("div", { staticClass: "company-entry-block-row-title" }, [
          _vm._v("Дата и время")
        ]),
        _vm._v(" "),
        _c("div", { attrs: { id: "company-entry-block-row-date" } }, [
          _vm._v("10–11–2020 17:30")
        ])
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "company-entry-block-row-no-grow" }, [
        _c("div", { staticClass: "company-entry-block-row-title" }, [
          _vm._v("Вид услуги:")
        ]),
        _vm._v(" "),
        _c("div", { attrs: { id: "company-entry-block-row-services-type" } }, [
          _vm._v("Шиномонтаж")
        ])
      ]),
      _vm._v(" "),
      _c(
        "label",
        {
          staticClass: "company-entry-block-textarea-title",
          attrs: { for: "company-entry-block-textarea" }
        },
        [
          _vm._v(
            "Дополнительная\n                информация: (описание проблемы)\n                "
          ),
          _c("textarea", { attrs: { id: "company-entry-block-textarea" } })
        ]
      )
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "company-entry-block-row" }, [
      _c(
        "label",
        {
          staticClass: "company-entry-block-row-label",
          attrs: { for: "company-entry-row-input-gos-znak" }
        },
        [_vm._v("Государственный\n                    регистрационный знак:")]
      ),
      _vm._v(" "),
      _c("input", {
        staticClass: "company-entry-block-row-input",
        attrs: {
          id: "company-entry-row-input-gos-znak",
          placeholder: "Х000ХХ199"
        }
      })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "company-entry-block-row" }, [
      _c(
        "label",
        {
          staticClass: "company-entry-block-row-label",
          attrs: { for: "company-entry-row-input-model-auto" }
        },
        [_vm._v("Модель\n                    авто:")]
      ),
      _vm._v(" "),
      _c("input", {
        staticClass: "company-entry-block-row-input",
        attrs: {
          id: "company-entry-row-input-model-auto",
          placeholder: "ГАЗ 2101"
        }
      })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "company-entry-block-row" }, [
      _c(
        "label",
        {
          staticClass: "company-entry-block-row-label",
          attrs: { for: "company-entry-row-input-phone" }
        },
        [_vm._v("Телефон для\n                    связи:")]
      ),
      _vm._v(" "),
      _c("input", {
        staticClass: "company-entry-block-row-input",
        attrs: {
          id: "company-entry-row-input-phone",
          placeholder: "+7 (999) 999-99-99"
        }
      })
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/UI/OrderDetails.vue":
/*!*****************************************************!*\
  !*** ./resources/js/components/UI/OrderDetails.vue ***!
  \*****************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _OrderDetails_vue_vue_type_template_id_52ef4058___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./OrderDetails.vue?vue&type=template&id=52ef4058& */ "./resources/js/components/UI/OrderDetails.vue?vue&type=template&id=52ef4058&");
/* harmony import */ var _OrderDetails_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./OrderDetails.vue?vue&type=script&lang=js& */ "./resources/js/components/UI/OrderDetails.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _OrderDetails_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _OrderDetails_vue_vue_type_template_id_52ef4058___WEBPACK_IMPORTED_MODULE_0__["render"],
  _OrderDetails_vue_vue_type_template_id_52ef4058___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/UI/OrderDetails.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/UI/OrderDetails.vue?vue&type=script&lang=js&":
/*!******************************************************************************!*\
  !*** ./resources/js/components/UI/OrderDetails.vue?vue&type=script&lang=js& ***!
  \******************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_OrderDetails_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./OrderDetails.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/UI/OrderDetails.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_OrderDetails_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/UI/OrderDetails.vue?vue&type=template&id=52ef4058&":
/*!************************************************************************************!*\
  !*** ./resources/js/components/UI/OrderDetails.vue?vue&type=template&id=52ef4058& ***!
  \************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_OrderDetails_vue_vue_type_template_id_52ef4058___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./OrderDetails.vue?vue&type=template&id=52ef4058& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/UI/OrderDetails.vue?vue&type=template&id=52ef4058&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_OrderDetails_vue_vue_type_template_id_52ef4058___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_OrderDetails_vue_vue_type_template_id_52ef4058___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);