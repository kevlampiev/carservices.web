(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[2],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/UI/login.vue?vue&type=script&lang=js&":
/*!*******************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/UI/LoginComp.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vuelidate/lib/validators */ "./node_modules/vuelidate/lib/validators/index.js");
/* harmony import */ var vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_0__);
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
  validations: {
    orderDetails: {
      car_model: {
        required: vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_0__["required"],
        minLength: Object(vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_0__["minLength"])(3)
      },
      license_plate_number: {
        required: vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_0__["required"],
        minLength: Object(vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_0__["minLength"])(8)
      },
      description: {},
      telephone: {
        validPhone: function validPhone(val) {
          var phoneTmpl = new RegExp('^((8|\\+7)[\\- ]?)?(\\(?\\d{3}\\)?[\\- ]?)?[\\d\\- ]{7,10}$');
          return phoneTmpl.test(val);
        }
      }
    }
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
    },
    gosNumbLngth: function gosNumbLngth() {
      return this.$v.orderDetails.license_plate_number.$params.minLength.min;
    }
  },
  methods: {
    sendOrderToServer: function sendOrderToServer() {
      var _this = this;

      if (this.$v.$invalid) {
        this.$v.$touch();
        return -1;
      }

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

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/UI/login.vue?vue&type=template&id=f2cf0b0e&":
/*!***********************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/UI/LoginComp.vue?vue&type=template&id=f2cf0b0e& ***!
  \***********************************************************************************************************************************************************************************************************/
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
      _c("div", { staticClass: "company-entry-block-wrapper" }, [
        _c("div", { staticClass: "company-entry-block-row" }, [
          _c(
            "label",
            {
              staticClass: "company-entry-block-row-label",
              attrs: { for: "company-entry-row-input-gos-znak" }
            },
            [_vm._v("e-mail:")]
          ),
          _vm._v(" "),
          _c("input", {
            directives: [
              {
                name: "model",
                rawName: "v-model",
                value: _vm.orderDetails.license_plate_number,
                expression: "orderDetails.license_plate_number"
              }
            ],
            class: {
              "company-entry-block-row-input": true,
              "invalid-data":
                (_vm.$v.orderDetails.license_plate_number.$dirty &&
                  !_vm.$v.orderDetails.license_plate_number.required) ||
                !_vm.$v.orderDetails.license_plate_number.minLength
            },
            attrs: {
              id: "company-entry-row-input-gos-znak",
              placeholder: "email@email.ru"
            },
            domProps: { value: _vm.orderDetails.license_plate_number },
            on: {
              input: function($event) {
                if ($event.target.composing) {
                  return
                }
                _vm.$set(
                  _vm.orderDetails,
                  "license_plate_number",
                  $event.target.value
                )
              }
            }
          })
        ]),
        _vm._v(" "),
        _vm.$v.orderDetails.license_plate_number.$dirty &&
        !_vm.$v.orderDetails.license_plate_number.required
          ? _c("small", { staticClass: "error-notificator" }, [
              _vm._v(
                "\n                Регистрационный знак должен быть указан\n            "
              )
            ])
          : _vm._e(),
        _vm._v(" "),
        _vm.$v.orderDetails.license_plate_number.$dirty &&
        !_vm.$v.orderDetails.license_plate_number.minLength
          ? _c("small", { staticClass: "error-notificator" }, [
              _vm._v(
                "\n                Минимальное количество знаков в регистрационном знаке - " +
                  _vm._s(_vm.gosNumbLngth) +
                  "\n            "
              )
            ])
          : _vm._e(),
        _vm._v(" "),
        _c("div", { staticClass: "company-entry-block-row" }, [
          _c(
            "label",
            {
              staticClass: "company-entry-block-row-label",
              attrs: { for: "company-entry-row-input-model-auto" }
            },
            [_vm._v("password:")]
          ),
          _vm._v(" "),
          _c("input", {
            directives: [
              {
                name: "model",
                rawName: "v-model",
                value: _vm.orderDetails.car_model,
                expression: "orderDetails.car_model"
              }
            ],
            staticClass: "company-entry-block-row-input",
            class: {
              "invalid-data":
                _vm.$v.orderDetails.car_model.$dirty &&
                !_vm.$v.orderDetails.car_model.required
            },
            attrs: {
              id: "company-entry-row-input-model-auto",
              placeholder: "ГАЗ 2101"
            },
            domProps: { value: _vm.orderDetails.car_model },
            on: {
              input: function($event) {
                if ($event.target.composing) {
                  return
                }
                _vm.$set(_vm.orderDetails, "car_model", $event.target.value)
              }
            }
          })
        ]),
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
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/UI/login.vue":
/*!**********************************************!*\
  !*** ./resources/js/components/UI/LoginComp.vue ***!
  \**********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _login_vue_vue_type_template_id_f2cf0b0e___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./LoginComp.vue?vue&type=template&id=f2cf0b0e& */ "./resources/js/components/UI/login.vue?vue&type=template&id=f2cf0b0e&");
/* harmony import */ var _login_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./LoginComp.vue?vue&type=script&lang=js& */ "./resources/js/components/UI/login.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _login_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _login_vue_vue_type_template_id_f2cf0b0e___WEBPACK_IMPORTED_MODULE_0__["render"],
  _login_vue_vue_type_template_id_f2cf0b0e___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null

)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/UI/LoginComp.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/UI/login.vue?vue&type=script&lang=js&":
/*!***********************************************************************!*\
  !*** ./resources/js/components/UI/LoginComp.vue?vue&type=script&lang=js& ***!
  \***********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_login_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./LoginComp.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/UI/login.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_login_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]);

/***/ }),

/***/ "./resources/js/components/UI/login.vue?vue&type=template&id=f2cf0b0e&":
/*!*****************************************************************************!*\
  !*** ./resources/js/components/UI/LoginComp.vue?vue&type=template&id=f2cf0b0e& ***!
  \*****************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_login_vue_vue_type_template_id_f2cf0b0e___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./LoginComp.vue?vue&type=template&id=f2cf0b0e& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/UI/login.vue?vue&type=template&id=f2cf0b0e&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_login_vue_vue_type_template_id_f2cf0b0e___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_login_vue_vue_type_template_id_f2cf0b0e___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);
