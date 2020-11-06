(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[1], {

    /***/
    "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/UI/OrderDetails.vue?vue&type=script&lang=js&":
    /*!**************************************************************************************************************************************************************************!*\
      !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/UI/OrderDetails.vue?vue&type=script&lang=js& ***!
      \**************************************************************************************************************************************************************************/
    /*! exports provided: default */
    /***/ (function (module, __webpack_exports__, __webpack_require__) {

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
        /* harmony default export */
        __webpack_exports__["default"] = ({
            props: ['close'],
            methods: {
                makeOrder: function makeOrder() {
                    alert('как будто сделан заказ');
                    this.close();
                }
            },
            mounted: function mounted() {
            }
        });

        /***/
    }),

    /***/
    "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/UI/OrderDetails.vue?vue&type=template&id=52ef4058&":
    /*!******************************************************************************************************************************************************************************************************************!*\
      !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/UI/OrderDetails.vue?vue&type=template&id=52ef4058& ***!
      \******************************************************************************************************************************************************************************************************************/
    /*! exports provided: render, staticRenderFns */
    /***/ (function (module, __webpack_exports__, __webpack_require__) {

        "use strict";
        __webpack_require__.r(__webpack_exports__);
        /* harmony export (binding) */
        __webpack_require__.d(__webpack_exports__, "render", function () {
            return render;
        });
        /* harmony export (binding) */
        __webpack_require__.d(__webpack_exports__, "staticRenderFns", function () {
            return staticRenderFns;
        });
        var render = function () {
            var _vm = this
            var _h = _vm.$createElement
            var _c = _vm._self._c || _h
            return _c("div", [
                _c("h3", [_vm._v("Оформить запись на сервис")]),
                _vm._v(" "),
                _c("h4", [_vm._v("Дата и время")]),
                _vm._v(" "),
                _c("p", [_vm._v("19-11-2020 18:45")]),
                _vm._v(" "),
                _c("h4", [_vm._v("Вид услуг")]),
                _vm._v(" "),
                _c("p", [_vm._v("Шиномонтаж")]),
                _vm._v(" "),
                _vm._m(0),
                _vm._v(" "),
                _vm._m(1),
                _vm._v(" "),
                _vm._m(2),
                _vm._v(" "),
                _vm._m(3),
                _vm._v(" "),
                _c(
                    "button",
                    {
                        staticClass: "btn btn-primary",
                        attrs: {type: "button"},
                        on: {click: _vm.makeOrder}
                    },
                    [_vm._v("Ok")]
                ),
                _vm._v(" "),
                _c(
                    "button",
                    {
                        staticClass: "btn btn-outline-secondary",
                        attrs: {type: "button"},
                        on: {click: _vm.close}
                    },
                    [_vm._v("Отмена")]
                )
            ])
        }
        var staticRenderFns = [
            function () {
                var _vm = this
                var _h = _vm.$createElement
                var _c = _vm._self._c || _h
                return _c("div", {staticClass: "form-group"}, [
                    _c("label", {attrs: {for: "carModel"}}, [
                        _vm._v("Модель автомобиля")
                    ]),
                    _vm._v(" "),
                    _c("input", {
                        staticClass: "form-control",
                        attrs: {type: "text", id: "carModel", placeholder: "ГАЗ 3101"}
                    })
                ])
            },
            function () {
                var _vm = this
                var _h = _vm.$createElement
                var _c = _vm._self._c || _h
                return _c("div", {staticClass: "form-group"}, [
                    _c("label", {attrs: {for: "licensePlateNumber"}}, [
                        _vm._v("Государствыенный регистрационный знак")
                    ]),
                    _vm._v(" "),
                    _c("input", {
                        staticClass: "form-control",
                        attrs: {
                            type: "text",
                            id: "licensePlateNumber",
                            placeholder: "x000XX199"
                        }
                    })
                ])
            },
            function () {
                var _vm = this
                var _h = _vm.$createElement
                var _c = _vm._self._c || _h
                return _c("div", {staticClass: "form-group"}, [
                    _c("label", {attrs: {for: "description"}}, [
                        _vm._v("Дополнительная информация (описание проблемы)")
                    ]),
                    _vm._v(" "),
                    _c("textarea", {
                        staticClass: "form-control",
                        attrs: {id: "description", rows: "3"}
                    })
                ])
            },
            function () {
                var _vm = this
                var _h = _vm.$createElement
                var _c = _vm._self._c || _h
                return _c("div", {staticClass: "form-group"}, [
                    _c("label", {attrs: {for: "telephone"}}, [
                        _vm._v("Телефон для связи")
                    ]),
                    _vm._v(" "),
                    _c("input", {
                        staticClass: "form-control",
                        attrs: {type: "text", id: "telephone", placeholder: "+7(900)000-0000"}
                    })
                ])
            }
        ]
        render._withStripped = true


        /***/
    }),

    /***/
    "./resources/js/components/UI/OrderDetails.vue":
    /*!*****************************************************!*\
      !*** ./resources/js/components/UI/OrderDetails.vue ***!
      \*****************************************************/
    /*! exports provided: default */
    /***/ (function (module, __webpack_exports__, __webpack_require__) {

        "use strict";
        __webpack_require__.r(__webpack_exports__);
        /* harmony import */
        var _OrderDetails_vue_vue_type_template_id_52ef4058___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./OrderDetails.vue?vue&type=template&id=52ef4058& */ "./resources/js/components/UI/OrderDetails.vue?vue&type=template&id=52ef4058&");
        /* harmony import */
        var _OrderDetails_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./OrderDetails.vue?vue&type=script&lang=js& */ "./resources/js/components/UI/OrderDetails.vue?vue&type=script&lang=js&");
        /* empty/unused harmony star reexport *//* harmony import */
        var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");


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
        if (false) {
            var api;
        }
        component.options.__file = "resources/js/components/UI/OrderDetails.vue"
        /* harmony default export */
        __webpack_exports__["default"] = (component.exports);

        /***/
    }),

    /***/
    "./resources/js/components/UI/OrderDetails.vue?vue&type=script&lang=js&":
    /*!******************************************************************************!*\
      !*** ./resources/js/components/UI/OrderDetails.vue?vue&type=script&lang=js& ***!
      \******************************************************************************/
    /*! exports provided: default */
    /***/ (function (module, __webpack_exports__, __webpack_require__) {

        "use strict";
        __webpack_require__.r(__webpack_exports__);
        /* harmony import */
        var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_OrderDetails_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./OrderDetails.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/UI/OrderDetails.vue?vue&type=script&lang=js&");
        /* empty/unused harmony star reexport */ /* harmony default export */
        __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_OrderDetails_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]);

        /***/
    }),

    /***/
    "./resources/js/components/UI/OrderDetails.vue?vue&type=template&id=52ef4058&":
    /*!************************************************************************************!*\
      !*** ./resources/js/components/UI/OrderDetails.vue?vue&type=template&id=52ef4058& ***!
      \************************************************************************************/
    /*! exports provided: render, staticRenderFns */
    /***/ (function (module, __webpack_exports__, __webpack_require__) {

        "use strict";
        __webpack_require__.r(__webpack_exports__);
        /* harmony import */
        var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_OrderDetails_vue_vue_type_template_id_52ef4058___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./OrderDetails.vue?vue&type=template&id=52ef4058& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/UI/OrderDetails.vue?vue&type=template&id=52ef4058&");
        /* harmony reexport (safe) */
        __webpack_require__.d(__webpack_exports__, "render", function () {
            return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_OrderDetails_vue_vue_type_template_id_52ef4058___WEBPACK_IMPORTED_MODULE_0__["render"];
        });

        /* harmony reexport (safe) */
        __webpack_require__.d(__webpack_exports__, "staticRenderFns", function () {
            return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_OrderDetails_vue_vue_type_template_id_52ef4058___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"];
        });


        /***/
    })

}]);
