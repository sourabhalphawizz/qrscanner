<template>
    <LoadingComponent :props="loading" />
    <section class=" pb-16 bgorder">
        <div class="container-fluid">
            <div class="order-header pt-8 ">
                <router-link :to="{ name: 'table.menu.table', params: { slug: this.$route.params.slug } }"
                    class="text-xs pl-4 font-medium inline-flex mb-3 items-center gap-2 ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="16" viewBox="0 0 18 16" fill="none">
                        <path
                            d="M7.5 15.5L8.5575 14.4425L2.8725 8.75H18V7.25H2.8725L8.5575 1.5575L7.5 0.5L0 8L7.5 15.5Z"
                            fill="black" />
                    </svg>
                    <h3>{{ $t('label.back_to_home') }}</h3>
                </router-link>
                <div class="toporder">
                    <div class="timeblock">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M21.2498 12.0005C21.2498 17.1095 17.1088 21.2505 11.9998 21.2505C6.89076 21.2505 2.74976 17.1095 2.74976 12.0005C2.74976 6.89149 6.89076 2.75049 11.9998 2.75049C17.1088 2.75049 21.2498 6.89149 21.2498 12.0005Z"
                                stroke="#E52B50" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M15.4314 14.9429L11.6614 12.6939V7.84689" stroke="#E52B50" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <h6>35-40 mins to reach you</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="container max-w-[965px] pt-2">

            <div class="row">
                <div class="col-12 md:col-7">
                    <div class="mb-4 rounded-2xl shadow-xs bg-white">

                    </div>
                    <div class="mb-4 rounded-2xl shadow-xs bg-white p-2 ">
                        <div class="first_checkout hidden">
                            <div v-for="cart in carts"
                                class="mb-3 pb-3 border-b  last:mb-0 last:pb-0 last:border-b-0 border-gray-2">
                                <div class="flex items-center gap-3 relative">

                                    <img :src="cart.image" alt="thumbnail"
                                        class="food_card_img rounded-lg flex-shrink-0">
                                    <div class="w-full order_detail-card">
                                        <div class="order-name">
                                            <img src="../../../../../public/images/veg.png" alt="">
                                            <span class="text-sm font-medium capitalize transition text-heading">
                                                {{ cart.name }}
                                            </span>
                                        </div>
                                        <div class="w-full cart_bottom food-price">
                                            <p v-if="Object.keys(cart.item_variations.variations).length !== 0"
                                                class="capitalize text-xs mb-1.5">
                                                <span v-for="(variation, variationName) in cart.item_variations.names">
                                                    {{ variationName }}: {{ variation }}, &nbsp;
                                                </span>
                                            </p>
                                            <div class="add_more">
                                                <h4>-</h4>
                                                <h3
                                                    class=" text-sm w-[26px] h-[26px] leading-[26px] text-center rounded-full text-black">
                                                    {{ cart.quantity }}</h3>
                                                <h4>+</h4>
                                            </div>

                                            <h4 class="text-sm font-semibold">
                                                {{
                                                    currencyFormat(cart.total, setting.site_digit_after_decimal_point,
                                                        setting.site_default_currency_symbol, setting.site_currency_position)
                                                }}
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <ul v-if="cart.item_extras.extras.length > 0 || cart.instruction !== ''"
                                    class="flex flex-col gap-1.5 mt-2">
                                    <li v-if="cart.item_extras.extras.length > 0" class="flex gap-1">
                                        <h3 class="capitalize text-xs w-fit whitespace-nowrap">
                                            {{ $t('label.extras') }}:
                                        </h3>
                                        <p class="text-xs">
                                            <span v-for="extra in cart.item_extras.names">
                                                {{ extra }}, &nbsp;
                                            </span>
                                        </p>
                                    </li>
                                    <li v-if="cart.instruction !== ''" class="flex gap-1">
                                        <h3 class="capitalize text-xs w-fit whitespace-nowrap">
                                            {{ $t('label.instruction') }}:
                                        </h3>
                                        <p class="text-xs">{{ cart.instruction }}</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div :class="carts.length === 0 ? 'flex items-center justify-center flex-col text-center' : 'max-h-[calc(100vh-200px)] lg:max-h-[calc(100vh-220px)] thin-scrolling overflow-y-auto'"
                            class="p-4 relative">
                            <div v-if="carts.length === 0"
                                class="flex items-center justify-center flex-col text-center flex-col text-center">
                                <img class="w-40 mb-12" :src="setting.image_cart" alt="gif">
                                <p class="text-sm max-w-xs">{{ $t('message.empty_cart') }}</p>
                            </div>
                            <div v-if="carts.length > 0"
                                class="mb-5 border-b  last:mb-0 last:pb-0 last:border-b-0 border-gray-2">
                                <div v-for="(cart, index) in carts"
                                    class="mb-3 pb-3 border-b last:mb-0 last:pb-0 last:border-b-0 border-gray-2">
                                    <div class="flex items-center gap-3 mb-2">
                                        <img class=" rounded-lg flex-shrink-0 checkout-img" :src="cart.image"
                                            alt="thumbnail">
                                        <div class="w-full ">
                                            <div class="flex items-center gap-2 mb-2 ">
                                                <img v-if="cart.item_type === 5"
                                                    src="../../../../../public/images/veg.png" alt="">
                                                <img v-if="cart.item_type === 10"
                                                    src="../../../../../public/images/non-veg.png" alt="">
                                                <a href="#"
                                                    class="text-sm font-medium capitalize transition text-heading hover:underline">
                                                    {{ cart.name }}
                                                </a>
                                            </div>
                                            <p v-if="Object.keys(cart.item_variations.variations).length !== 0"
                                                class="capitalize text-xs mb-1.5"><span
                                                    v-for="(variation, variationName) in cart.item_variations.names">
                                                    {{ variationName }}: {{ variation }}, &nbsp;</span>
                                            </p>
                                            <div class="flex items-center justify-between gap-2">
                                                <div class="flex items-center indec-group py-1 px-2">
                                                    <button @click.prevent="quantityDecrement(index)"
                                                        :class="cart.quantity === 1 ? 'fa-trash-can' : 'fa-minus'"
                                                        class="fa-solid text-[14px] w-[18px] h-[18px] leading-4 text-center  hover:text-white indec-minus"></button>
                                                    <input v-on:keypress="onlyNumber($event)"
                                                        v-on:keyup="quantityUp(index, $event)" type="number"
                                                        :value="cart.quantity"
                                                        class="text-center w-7 text-xs font-semibold text-heading indec-value">
                                                    <button @click.prevent="quantityIncrement(index)"
                                                        class="fa-solid fa-plus text-[14px] w-[18px] h-[18px] leading4 text-center  hover:text-white indec-plus"></button>
                                                </div>
                                                <h3 class="text-xs font-semibold">
                                                    {{ currencyFormat(cart.total,
                                                        setting.site_digit_after_decimal_point,
                                                        setting.site_default_currency_symbol,
                                                        setting.site_currency_position) }}
                                                </h3>
                                            </div>
                                        </div>
                                    </div>

                                    <ul v-if="cart.item_extras.extras.length > 0 || cart.instruction !== ''"
                                        class="flex flex-col gap-1.5">
                                        <li v-if="cart.item_extras.extras.length > 0" class="flex gap-1">
                                            <h3 class="capitalize text-xs w-fit whitespace-nowrap">{{ $t('label.extras')
                                                }}:</h3>
                                            <p class="text-xs">
                                                <span v-for="extra in cart.item_extras.names">
                                                    {{ extra }}, &nbsp;
                                                </span>
                                            </p>
                                        </li>
                                        <li v-if="cart.instruction !== ''" class="flex gap-1">
                                            <h3 class="capitalize text-xs w-fit whitespace-nowrap">
                                                {{ $t('label.instruction') }}:
                                            </h3>
                                            <p class="text-xs">{{ cart.instruction }}</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="first_checkout">
                            <div class="more_item">
                                <router-link
                                    :to="{ name: 'table.menu.table', params: { slug: this.$route.params.slug } }"
                                    class="text-xs pl-4 font-medium inline-flex mb-3 items-center gap-2 ">
                                    <h2>Add More Items</h2> <svg xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 320 512">
                                        <path
                                            d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z" />
                                    </svg>
                                </router-link>
                            </div>
                        </div>
                        <div class="first_checkout-1">
                            <div class="more_item pt-2 pb-2">
                                <router-link to="" class="text-xs pl-4 font-medium  mb-3 items-center gap-2 ">
                                    <h2>Add Cooking Request</h2> <svg xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 320 512">
                                        <path
                                            d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z" />
                                    </svg>
                                </router-link>
                            </div>
                        </div>

                    </div>

                    <div class="mb-4 rounded-2xl shadow-xs bg-white hidden">
                        <h3 class="capitalize font-medium p-4 border-b border-gray-100">{{ $t('label.table') }}</h3>
                        <p class="capitalize p-4 text-heading">{{ $t('label.inside') }} - {{ table.name }}</p>
                    </div>

                    <div class="mb-4 rounded-2xl shadow-xs bg-white hidden">
                        <h3 class="capitalize font-medium p-4 border-b border-gray-100">{{ $t('label.payment') }}</h3>
                        <ul class="p-4 flex flex-col gap-5">
                            <li class="flex items-center gap-1.5">
                                <div class="custom-radio">
                                    <input type="radio" id="cash" v-model="paymentMethod" value="cashCard" checked
                                        class="custom-radio-field">
                                    <span class="custom-radio-span border-gray-400"></span>
                                </div>
                                <label for="cash" class="db-field-label text-heading">{{ $t('label.cash_card')
                                    }}</label>
                            </li>
                        </ul>
                    </div>


                    <div class="mb-4 rounded-2xl shadow-xs bg-white p-2  Recommend-sec">
                        <h3 class="capitalize font-medium py-2  ">Recommend Items</h3>
                        <div class="card-for-recomend">
                            <div class="first_checkout-card-recomennded">
                                <div class="mb-3 pb-3 border-b last:mb-0 last:pb-0 last:border-b-0 border-gray-2">
                                    <img src="http://localhost/foodscan/public/storage/109/conversions/Pizza-thumb.png"
                                        alt="thumbnail" class="food_card_img rounded-lg flex-shrink-0">
                                    <div class="w-full order_detail-card">
                                        <div class="order-name">
                                            <span
                                                class="text-sm font-medium capitalize transition text-heading">Pizza</span>
                                        </div>
                                        <div class="w-full cart_bottom food-price">
                                            <h4 class="text-sm font-semibold">₹450.00</h4>
                                        </div>
                                    </div>
                                    <button class="plus-btn-for-recom">+</button>

                                </div>
                            </div>
                            <div class="first_checkout-card-recomennded">
                                <div class="mb-3 pb-3 border-b last:mb-0 last:pb-0 last:border-b-0 border-gray-2">
                                    <img src="http://localhost/foodscan/public/storage/109/conversions/Pizza-thumb.png"
                                        alt="thumbnail" class="food_card_img rounded-lg flex-shrink-0">
                                    <div class="w-full order_detail-card">
                                        <div class="order-name">
                                            <span
                                                class="text-sm font-medium capitalize transition text-heading">Pizza</span>
                                        </div>
                                        <div class="w-full cart_bottom food-price">
                                            <h4 class="text-sm font-semibold">₹450.00</h4>
                                        </div>
                                    </div>
                                    <button class="plus-btn-for-recom">+</button>

                                </div>
                            </div>
                            <div class="first_checkout-card-recomennded">
                                <div class="mb-3 pb-3 border-b last:mb-0 last:pb-0 last:border-b-0 border-gray-2">
                                    <img src="http://localhost/foodscan/public/storage/109/conversions/Pizza-thumb.png"
                                        alt="thumbnail" class="food_card_img rounded-lg flex-shrink-0">
                                    <div class="w-full order_detail-card">
                                        <div class="order-name">
                                            <span
                                                class="text-sm font-medium capitalize transition text-heading">Pizza</span>
                                        </div>
                                        <div class="w-full cart_bottom food-price">
                                            <h4 class="text-sm font-semibold">₹450.00</h4>
                                        </div>
                                    </div>
                                    <button class="plus-btn-for-recom">+</button>

                                </div>
                            </div>
                            <div class="first_checkout-card-recomennded">
                                <div class="mb-3 pb-3 border-b last:mb-0 last:pb-0 last:border-b-0 border-gray-2">
                                    <img src="http://localhost/foodscan/public/storage/109/conversions/Pizza-thumb.png"
                                        alt="thumbnail" class="food_card_img rounded-lg flex-shrink-0">
                                    <div class="w-full order_detail-card">
                                        <div class="order-name">
                                            <span
                                                class="text-sm font-medium capitalize transition text-heading">Pizza</span>
                                        </div>
                                        <div class="w-full cart_bottom food-price">
                                            <h4 class="text-sm font-semibold">₹450.00</h4>
                                        </div>
                                    </div>
                                    <button class="plus-btn-for-recom">+</button>

                                </div>
                            </div>
                            <div class="first_checkout-card-recomennded">
                                <div class="mb-3 pb-3 border-b last:mb-0 last:pb-0 last:border-b-0 border-gray-2">
                                    <img src="http://localhost/foodscan/public/storage/109/conversions/Pizza-thumb.png"
                                        alt="thumbnail" class="food_card_img rounded-lg flex-shrink-0">
                                    <div class="w-full order_detail-card">
                                        <div class="order-name">
                                            <span
                                                class="text-sm font-medium capitalize transition text-heading">Pizza</span>
                                        </div>
                                        <div class="w-full cart_bottom food-price">
                                            <h4 class="text-sm font-semibold">₹450.00</h4>
                                        </div>
                                    </div>
                                    <button class="plus-btn-for-recom">+</button>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class=" rounded-2xl shadow-xs bg-white p-2">
                        <div class="spply-coopan-sec">
                            <h3 class="capitalize font-medium py-2  ">Coupon & Offers</h3>
                            <router-link :to="{ name: 'table.coupons', params: { slug: this.$route.params.slug } }"
                                class="webcart1">
                                <button class="View-Offer">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.8497 4.25V6.67" stroke="#6E6BFF" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M13.8497 17.7598V19.7838" stroke="#6E6BFF" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M13.8497 14.3239V9.50293" stroke="#6E6BFF" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M18.7021 20C20.5242 20 22 18.5426 22 16.7431V14.1506C20.7943 14.1506 19.8233 13.1917 19.8233 12.001C19.8233 10.8104 20.7943 9.85039 22 9.85039L21.999 7.25686C21.999 5.45745 20.5221 4 18.7011 4H5.29892C3.47789 4 2.00104 5.45745 2.00104 7.25686L2 9.93485C3.20567 9.93485 4.17668 10.8104 4.17668 12.001C4.17668 13.1917 3.20567 14.1506 2 14.1506V16.7431C2 18.5426 3.4758 20 5.29787 20H18.7021Z"
                                            stroke="#6E6BFF" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                    View Offer
                                </button> 
                            </router-link>
                        </div>
                        <div class="spply-coopan-sec">
                            <input type="text"
                                class="h-10  placeholder:text-[15px]  border-[#D9DBE9] pl-4 coopen-code-text"
                                placeholder="Enter coupon code">
                            <button class="btn btnwhite btn-coupon apply-coopen">Apply</button>
                        </div>
                    </div>
                    <button type="button"
                        class="hidden md:block w-full rounded-3xl capitalize font-medium leading-6 py-3 text-white bg-primary "
                        @click="orderSubmit">
                        {{ $t('button.place_order') }}
                    </button>
                </div>

                <div class="col-12 md:col-5">
                    <div class="rounded-2xl shadow-xs bg-white p-4">
                        <div class="whatsblock">
                            <div>
                                <h4>Confirm Your Mobile Number</h4>
                            </div>
                        </div>
                        <div class="formlayout">
                            <div class="formvuiew">
                                <input type="text"
                                    class="h-10 w-full rounded-lg border py-1.5 px-2 placeholder:text-[15px] placeholder:text-[#6E7191] border-[#D9DBE9] mb-4 pl-4"
                                    placeholder="Customer Name">
                            </div>
                            <div class="formvuiew">
                                <input type="text"
                                    class="h-10 w-full rounded-lg border py-1.5 px-2 placeholder:text-[15px] placeholder:text-[#6E7191] border-[#D9DBE9] pl-4"
                                    placeholder="Mobile Number">
                            </div>
                            <p>Yes, I want to receive important information & updates of order on my Mobile</p>
                        </div>
                        <div class="py-4">
                            <div class="rounded-xl mb-3  billdetails">
                                <h3 class="capitalize font-medium mb-1 cart-sunmmery-text ">
                                    {{ $t('label.cart_summary') }}
                                </h3>
                                <ul class="flex flex-col gap-2 border-b border-dashed border-[#EFF0F6]">
                                    <li class="flex items-center justify-between text-heading">
                                        <span class="text-sm leading-6 capitalize">
                                            {{ $t('label.subtotal') }}
                                        </span>
                                        <span class="text-sm leading-6 capitalize">
                                            {{
                                                currencyFormat(subtotal, setting.site_digit_after_decimal_point,
                                                    setting.site_default_currency_symbol, setting.site_currency_position)
                                            }}
                                        </span>
                                    </li>
                                </ul>
                                <div class="flex items-center justify-between">
                                    <h4 class="text-sm leading-6 font-semibold capitalize">
                                        {{ $t('label.total') }}
                                    </h4>
                                    <h5 class="text-sm leading-6 font-semibold capitalize">
                                        {{
                                            currencyFormat(subtotal, setting.site_digit_after_decimal_point,
                                                setting.site_default_currency_symbol, setting.site_currency_position)
                                        }}
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" shadow-xs bg-white py-4 place-order-btn-sec">
                        <button type="button"
                            class="block md:hidden w-full rounded-3xl capitalize font-medium leading-6 py-2 text-white bg-primary btn-place_order "
                            @click="orderSubmit">
                            {{ $t('button.place_order') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import LoadingComponent from "../../table/components/LoadingComponent.vue";
import appService from "../../../services/appService";
import sourceEnum from "../../../enums/modules/sourceEnum";
import _ from "lodash";
import OrderTypeEnum from "../../../enums/modules/orderTypeEnum";
import IsAdvanceOrderEnum from "../../../enums/modules/isAdvanceOrderEnum";
import router from "../../../router";
import alertService from "../../../services/alertService";
//import ItemAddonListComponent from "./addon/ItemAddonListComponent";

export default {
    name: "CheckoutComponent",
    components: { LoadingComponent },
    data() {
        return {
            loading: {
                isActive: false,
            },
            placeOrderShow: false,
            paymentMethod: null,
            checkoutProps: {
                form: {
                    dining_table_id: null,
                    customer_id: 2,
                    branch_id: null,
                    subtotal: 0,
                    discount: 0,
                    delivery_charge: 0,
                    delivery_time: null,
                    total: 0,
                    order_type: OrderTypeEnum.DINING_TABLE,
                    is_advance_order: IsAdvanceOrderEnum.NO,
                    source: sourceEnum.WEB,
                    address_id: null,
                    items: []
                }
            },
        }
    },
    mounted() {
        if (this.$store.getters['tableCart/lists'].length === 0) {
            this.$router.push({ name: 'table.menu.table', params: { slug: this.$route.params.slug } });
        }
    },
    computed: {
        setting: function () {
            return this.$store.getters['frontendSetting/lists'];
        },
        carts: function () {
            return this.$store.getters['tableCart/lists'];
        },
        subtotal: function () {
            return this.$store.getters['tableCart/subtotal'];
        },
        table: function () {
            return this.$store.getters['tableCart/table'];
        }
    },
    methods: {
        onlyNumber: function (e) {
            return appService.onlyNumber(e);
        },
        quantityUp: function (id, e) {
            if (e.target.value > 0) {
                this.$store.dispatch('tableCart/quantity', { id: id, status: e.target.value }).then().catch();
            }
        },
        quantityIncrement: function (id) {
            this.$store.dispatch('tableCart/quantity', { id: id, status: "increment" }).then().catch();
        },
        quantityDecrement: function (id) {
            this.$store.dispatch('tableCart/quantity', { id: id, status: "decrement" }).then().catch();
        },
        currencyFormat: function (amount, decimal, currency, position) {
            return appService.currencyFormat(amount, decimal, currency, position);
        },
        orderSubmit: function () {
            this.loading.isActive = true;
            this.checkoutProps.form.dining_table_id = this.table.id;
            this.checkoutProps.form.branch_id = this.table.branch_id;
            this.checkoutProps.form.subtotal = this.subtotal;
            this.checkoutProps.form.total = parseFloat(this.subtotal).toFixed(this.setting.site_digit_after_decimal_point);
            this.checkoutProps.form.items = [];
            _.forEach(this.carts, (item, index) => {
                let item_variations = [];
                if (Object.keys(item.item_variations.variations).length > 0) {
                    _.forEach(item.item_variations.variations, (value, index) => {
                        item_variations.push({
                            "id": value,
                            "item_id": item.item_id,
                            "item_attribute_id": index,
                        });
                    });
                }

                if (Object.keys(item.item_variations.names).length > 0) {
                    let i = 0;
                    _.forEach(item.item_variations.names, (value, index) => {
                        item_variations[i].variation_name = index;
                        item_variations[i].name = value;
                        i++;
                    });
                }

                let item_extras = [];
                if (item.item_extras.extras.length) {
                    _.forEach(item.item_extras.extras, (value) => {
                        item_extras.push({
                            id: value,
                            item_id: item.item_id,
                        });
                    });
                }

                if (item.item_extras.names.length) {
                    let i = 0;
                    _.forEach(item.item_extras.names, (value) => {
                        item_extras[i].name = value;
                        i++;
                    });
                }

                this.checkoutProps.form.items.push({
                    item_id: item.item_id,
                    item_price: item.convert_price,
                    branch_id: this.checkoutProps.form.branch_id,
                    instruction: item.instruction,
                    quantity: item.quantity,
                    discount: item.discount,
                    total_price: item.total,
                    item_variation_total: item.item_variation_total,
                    item_extra_total: item.item_extra_total,
                    item_variations: item_variations,
                    item_extras: item_extras
                });
            });
            this.checkoutProps.form.items = JSON.stringify(this.checkoutProps.form.items);

            this.$store.dispatch('tableDiningOrder/save', this.checkoutProps.form).then(orderResponse => {
                this.checkoutProps.form.subtotal = 0;
                this.checkoutProps.form.discount = 0;
                this.checkoutProps.form.delivery_charge = 0;
                this.checkoutProps.form.delivery_time = null;
                this.checkoutProps.form.total = 0;
                this.checkoutProps.form.items = [];

                this.$store.dispatch('tableCart/resetCart').then(res => {
                    this.loading.isActive = false;
                    this.$store.dispatch('tableCart/paymentMethod', this.paymentMethod).then().catch();
                    router.push({ name: "table.menu.table", params: { slug: this.table.slug }, query: { id: orderResponse.data.data.id } });
                }).catch();
            }).catch((err) => {
                this.loading.isActive = false;
                if (typeof err.response.data.errors === 'object') {
                    _.forEach(err.response.data.errors, (error) => {
                        alertService.error(error[0]);
                    });
                }
            })
        }
    }

}
</script>
