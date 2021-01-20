(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[4],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/UI/RegisterComp.vue?vue&type=script&lang=js&":
/*!**************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/UI/RegisterComp.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************************************************************************************************/
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
      form: {
        name: "",
        email: "",
        password: "",
        repeatPassword: ""
      }
    };
  },
  props: ['close'],
  validations: {
    form: {
      name: {
        required: vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_0__["required"],
        minLength: Object(vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_0__["minLength"])(1)
      },
      email: {
        required: vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_0__["required"],
        email: vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_0__["email"]
      },
      password: {
        required: vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_0__["required"],
        minLength: Object(vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_0__["minLength"])(8)
      },
      repeatPassword: {
        required: vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_0__["required"],
        sameAsPassword: Object(vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_0__["sameAs"])("password")
      }
    }
  },
  methods: {
    registerUser: function registerUser() {
      var _this = this;

      axios.post("/api/register", {
        name: this.form.name,
        email: this.form.email,
        password: this.form.password
      }).then(function (res) {
        _this.proceedRegistration(res);

        _this.close();
      })["catch"](function (err) {
        return console.log(err);
      });
    },
    cancelRegistration: function cancelRegistration() {
      this.$router.back();
    },
    //Функция обработки клиентского токена
    proceedRegistration: function proceedRegistration(response) {
      if (!response.data.token) {
        alert("Поле с токеном отсутствует");
      } else {
        this.$store.commit('setUserData', {
          email: this.form.email,
          token: response.data.token,
          rememberMe: false
        });
      }
    },
    showRegistrationError: function showRegistrationError(error) {
      alert("Какая-то хрень " + error.toString());
    },
    // Функция для проверки поля Name после :blur
    checkName: function checkName() {
      if (this.form.name) {
        this.$v.form.name.$model = this.form.name;
      }
    },
    // Функция для проверки поля Email после :blur
    checkEmail: function checkEmail() {
      if (this.form.email) {
        this.$v.form.email.$model = this.form.email;
      }
    },
    // Функция для проверки поля Password после :blur
    checkPassword: function checkPassword() {
      if (this.form.password) {
        this.$v.form.password.$model = this.form.password;
      }
    },
    // Функция для проверки поля RepeatPasswword после :blur
    checkRepeatPassword: function checkRepeatPassword() {
      if (this.form.repeatPasword) {
        this.$v.form.repeatPasword.$model = this.form.repeatPasword;
      }
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/UI/RegisterComp.vue?vue&type=template&id=27560a12&":
/*!******************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/UI/RegisterComp.vue?vue&type=template&id=27560a12& ***!
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
      _c("div", { staticClass: "company-entry-block-wrapper" }, [
        _c("div", { staticClass: "company-entry-block-row" }, [
          _c(
            "label",
            {
              staticClass: "company-entry-block-row-label",
              attrs: { for: "company-entry-row-input-name" }
            },
            [_vm._v("Имя:")]
          ),
          _vm._v(" "),
          _c("input", {
            directives: [
              {
                name: "model",
                rawName: "v-model.trim",
                value: _vm.form.name,
                expression: "form.name",
                modifiers: { trim: true }
              }
            ],
            class: {
              "company-entry-block-row-input": true,
              "invalid-data":
                !_vm.$v.form.name.minLength || !_vm.$v.form.name.required
            },
            attrs: { id: "company-entry-row-input-name", type: "name" },
            domProps: { value: _vm.form.name },
            on: {
              input: function($event) {
                if ($event.target.composing) {
                  return
                }
                _vm.$set(_vm.form, "name", $event.target.value.trim())
              },
              blur: function($event) {
                return _vm.$forceUpdate()
              }
            }
          })
        ]),
        _vm._v(" "),
        _vm.$v.form.name.dirty && !_vm.$v.form.name.minLength
          ? _c("small", { staticClass: "error-notificator" }, [
              _vm._v(
                "\n                Минимальное количество символов в имени должно быть " +
                  _vm._s(1) +
                  "\n            "
              )
            ])
          : _vm._e(),
        _vm._v(" "),
        _vm.$v.form.name.dirty && !_vm.$v.form.name.required
          ? _c("small", { staticClass: "error-notificator" }, [
              _vm._v(
                "\n                Для регистрации необходимо имя\n            "
              )
            ])
          : _vm._e(),
        _vm._v(" "),
        _c("div", { staticClass: "company-entry-block-row" }, [
          _c(
            "label",
            {
              staticClass: "company-entry-block-row-label",
              attrs: { for: "company-entry-row-input-email" }
            },
            [_vm._v("e-mail:")]
          ),
          _vm._v(" "),
          _c("input", {
            directives: [
              {
                name: "model",
                rawName: "v-model.trim",
                value: _vm.form.email,
                expression: "form.email",
                modifiers: { trim: true }
              }
            ],
            class: {
              "company-entry-block-row-input": true,
              "invalid-data":
                _vm.$v.form.email.dirty &&
                (!_vm.$v.form.email.email || !_vm.$v.form.email.required)
            },
            attrs: {
              id: "company-entry-row-input-email",
              placeholder: "email@email.ru",
              type: "email"
            },
            domProps: { value: _vm.form.email },
            on: {
              input: function($event) {
                if ($event.target.composing) {
                  return
                }
                _vm.$set(_vm.form, "email", $event.target.value.trim())
              },
              blur: function($event) {
                return _vm.$forceUpdate()
              }
            }
          })
        ]),
        _vm._v(" "),
        _vm.$v.form.email.dirty && !_vm.$v.form.email.email
          ? _c("small", { staticClass: "error-notificator" }, [
              _vm._v(
                "\n                Введенное значение не является адресом электронной почты\n            "
              )
            ])
          : _vm._e(),
        _vm._v(" "),
        _vm.$v.form.email.dirty && !_vm.$v.form.email.required
          ? _c("small", { staticClass: "error-notificator" }, [
              _vm._v(
                "\n                адрес электронной почты явялется обязательным для регистрации\n            "
              )
            ])
          : _vm._e(),
        _vm._v(" "),
        _c("div", { staticClass: "company-entry-block-row" }, [
          _c(
            "label",
            {
              staticClass: "company-entry-block-row-label",
              attrs: { for: "company-entry-row-input-password" }
            },
            [_vm._v("Пароль:")]
          ),
          _vm._v(" "),
          _c("input", {
            directives: [
              {
                name: "model",
                rawName: "v-model.trim",
                value: _vm.form.password,
                expression: "form.password",
                modifiers: { trim: true }
              }
            ],
            class: {
              "company-entry-block-row-input": true,
              "invalid-data":
                !_vm.$v.form.password.minLength &&
                !_vm.$v.form.password.required
            },
            attrs: { type: "password", id: "company-entry-row-input-password" },
            domProps: { value: _vm.form.password },
            on: {
              input: function($event) {
                if ($event.target.composing) {
                  return
                }
                _vm.$set(_vm.form, "password", $event.target.value.trim())
              },
              blur: function($event) {
                return _vm.$forceUpdate()
              }
            }
          })
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "company-entry-block-row" }, [
          _c(
            "label",
            {
              staticClass: "company-entry-block-row-label",
              attrs: { for: "company-entry-row-input-password" }
            },
            [_vm._v("Повторите пароль:")]
          ),
          _vm._v(" "),
          _c("input", {
            directives: [
              {
                name: "model",
                rawName: "v-model.trim",
                value: _vm.form.repeatPassword,
                expression: "form.repeatPassword",
                modifiers: { trim: true }
              }
            ],
            class: {
              "company-entry-block-row-input": true,
              "invalid-data":
                _vm.$v.form.repeatPassword.$dirty &&
                (!_vm.$v.form.repeatPassword.sameAsPassword ||
                  !_vm.$v.form.repeatPassword.required)
            },
            attrs: { type: "password" },
            domProps: { value: _vm.form.repeatPassword },
            on: {
              input: function($event) {
                if ($event.target.composing) {
                  return
                }
                _vm.$set(_vm.form, "repeatPassword", $event.target.value.trim())
              },
              blur: function($event) {
                return _vm.$forceUpdate()
              }
            }
          })
        ]),
        _vm._v(" "),
        _c(
          "button",
          {
            class: {
              "company-entry-block-button": true,
              "disabled-btn": _vm.$v.form.$anyError
            },
            attrs: { id: "company-entry-form-button", type: "button" },
            on: { click: _vm.registerUser }
          },
          [_vm._v("Ok\n            ")]
        )
      ])
    ])
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/UI/RegisterComp.vue":
/*!*****************************************************!*\
  !*** ./resources/js/components/UI/RegisterComp.vue ***!
  \*****************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _RegisterComp_vue_vue_type_template_id_27560a12___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./RegisterComp.vue?vue&type=template&id=27560a12& */ "./resources/js/components/UI/RegisterComp.vue?vue&type=template&id=27560a12&");
/* harmony import */ var _RegisterComp_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./RegisterComp.vue?vue&type=script&lang=js& */ "./resources/js/components/UI/RegisterComp.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _RegisterComp_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _RegisterComp_vue_vue_type_template_id_27560a12___WEBPACK_IMPORTED_MODULE_0__["render"],
  _RegisterComp_vue_vue_type_template_id_27560a12___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/UI/RegisterComp.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/UI/RegisterComp.vue?vue&type=script&lang=js&":
/*!******************************************************************************!*\
  !*** ./resources/js/components/UI/RegisterComp.vue?vue&type=script&lang=js& ***!
  \******************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_RegisterComp_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./RegisterComp.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/UI/RegisterComp.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_RegisterComp_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/UI/RegisterComp.vue?vue&type=template&id=27560a12&":
/*!************************************************************************************!*\
  !*** ./resources/js/components/UI/RegisterComp.vue?vue&type=template&id=27560a12& ***!
  \************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_RegisterComp_vue_vue_type_template_id_27560a12___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./RegisterComp.vue?vue&type=template&id=27560a12& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/UI/RegisterComp.vue?vue&type=template&id=27560a12&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_RegisterComp_vue_vue_type_template_id_27560a12___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_RegisterComp_vue_vue_type_template_id_27560a12___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);