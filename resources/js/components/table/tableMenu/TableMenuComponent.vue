<template>
    <section class="bannersec">
        <div class="container">
            <div class="col-sm-12 text-center">
                <div class="bannerview">
                    <img src="../../../../../public/images/topimage.gif" />
                </div>
            </div>
        </div>
    </section>
    <section class="mb-2 mt-4 categorysec">
        <div class="container">
            <h5 class="headingview">WHAT'S ON YOUR MIND?</h5>
            <LoadingComponent :props="loading" />
        </div>
    </section>
    <section class="mb-16 mt-4">
        <div class="container">
            <!--<LoadingComponent :props="loading" />-->

            <div class="swiper  menu-swiper mb-2" v-if="categories.length > 1">
        <div class="swiper-wrapper">
            <Carousel :settings="settings" :breakpoints="breakpoints">
                <Slide
                    class="swiper-slide"
                    v-for="(category, index) in categories.slice(
                        0,
                        categories.length > 7 ? 4 : categories.length
                    )"
                    :key="category"
                    :class="
                        category.id === itemProps.search.item_category_id ||
                        (category.id === 0 &&
                            itemProps.search.item_category_id === '')
                            ? 'pos-group'
                            : ''
                    "
                >
                    <router-link
                        v-if="index === 0"
                        to="#"
                        @click.prevent="allCategory(category)"
                        class="swiper-slide w-32 flex flex-col items-center text-center gap-4  overflow-hidden"
                    ><img src="../../../../../public/images/all-cat.png" />
                        <!--<img
                            class="h-10 "
                            :src="category.thumb"
                            alt="category"
                        />-->
                        <!--<h3
                            class="w-full text-xs leading-[16px] whitespace-nowrap overflow-hidden text-ellipsis font-medium font-rubik"
                        >
                            {{ category.name }}
                        </h3>-->
                    </router-link>
                    <router-link
                        v-else
                        to="#"
                        @click.prevent="setCategory(category.id, category.slug)"
                        class="swiper-slide w-32 flex flex-col items-center text-center gap-4   overflow-hidden"
                    >
                        <img
                            class="h-10 "
                            :src="category.thumb"
                            alt="category"
                        />
                        <!--<h3
                            class="w-full text-xs leading-[16px] whitespace-nowrap overflow-hidden text-ellipsis font-medium font-rubik"
                        >
                            {{ category.name }}
                        </h3>-->
                    </router-link>
                </Slide>
            </Carousel>
        </div>
    </div>

    <div class="swiper menu-swiper mb-3" v-if="categories.length > 7">
        <div class="swiper-wrapper">
            <Carousel :settings="settings" :breakpoints="breakpoints">
                <Slide
                    class="swiper-slide"
                    v-for="category in categories.slice(4)"
                    :key="category"
                    :class="
                        category.id === itemProps.search.item_category_id ||
                        (category.id === 0 &&
                            itemProps.search.item_category_id === '')
                            ? 'pos-group'
                            : ''
                    "
                >
                    <router-link
                        to="#"
                        @click.prevent="setCategory(category.id, category.slug)"
                        class="swiper-slide w-32 flex flex-col items-center text-center gap-4   overflow-hidden"
                    >
                        <img
                            class="h-10 drop-shadow-category"
                            :src="category.thumb"
                            alt="category"
                        />
                        <!--<h3
                            class="w-full text-xs leading-[16px] whitespace-nowrap overflow-hidden text-ellipsis font-medium font-rubik"
                        >
                            {{ category.name }}
                        </h3>-->
                    </router-link>
                </Slide>
            </Carousel>
        </div>
    </div>

    <div class="mb-7" v-if="banners.length > 0">
        <div>
            <Carousel :settings="bannerSettings">
                <Slide v-for="banner in banners" :key="banner">
                    <img :src="banner.image" alt="banner" />
                </Slide>
                <template #addons>
                    <Pagination />
                </template>
            </Carousel>
        </div>
    </div>







            <div v-if="categories.length > 0" class="flex flex-wrap gap-3 w-full mb-5 veg-navs">
                <button
                    :disabled="itemProps.property.type !== null && itemProps.property.type === enums.itemTypeEnum.NON_VEG"
                    @click.prevent="itemProps.property.type === enums.itemTypeEnum.VEG ? itemTypeReset() : itemTypeSet(enums.itemTypeEnum.VEG)"
                    :class="itemProps.property.type === enums.itemTypeEnum.VEG ? 'veg-active' : ''" type="button"
                    class="flex items-center gap-3 w-fit   p-1   transition hover:shadow-filter hover:bg-white border-for-tab-pils">
                    <img :src="setting.image_non_vag" alt="category" class="h-6">
                    <span class="capitalize text-sm font-medium text-heading">{{ $t('label.veg') }}</span>
                    <i
                        class="lab-close-circle-line text-xl text-red-500 transition opacity-0 -ml-8 font-fill-danger lab-font-size-24"></i>
                </button>

                <button :disabled="itemProps.property.type !== null &&
                itemProps.property.type === enums.itemTypeEnum.VEG
                " @click.prevent="
                    itemProps.property.type === enums.itemTypeEnum.NON_VEG
                        ? itemTypeReset()
                        : itemTypeSet(enums.itemTypeEnum.NON_VEG)
                    " :class="itemProps.property.type === enums.itemTypeEnum.NON_VEG
                        ? 'veg-active'
                        : ''
                        " type="button"
                class="flex items-center gap-3 w-fit p-1  transition hover:shadow-filter hover:bg-white border-for-tab-pils">
                <img :src="setting.image_vag" alt="category" class="h-6" />
                <span class="capitalize text-sm  text-heading">{{
                    $t("label.frontend_non_veg")
                }}</span>
                <i
                    class="lab-close-circle-line text-xl text-red-500 transition opacity-0 -ml-8 clear-item-type-filter font-fill-danger lab-font-size-24"></i>
            </button>


            <button :disabled="itemProps.property.type !== null &&
                itemProps.property.type === enums.itemTypeEnum.VEG
                " @click.prevent="
                    itemProps.property.type === enums.itemTypeEnum.NON_VEG
                        ? itemTypeReset()
                        : itemTypeSet(enums.itemTypeEnum.NON_VEG)
                    " :class="itemProps.property.type === enums.itemTypeEnum.NON_VEG
                        ? 'veg-active'
                        : ''
                        " type="button"
                class="flex items-center gap-3 w-fit   p-1  transition hover:shadow-filter hover:bg-white  border-for-tab-pils">
                <img src="../../../../../public/images/item-type/best-seller.png" alt="C" class="h-6" />
                <span class="capitalize text-sm  text-heading">Best Seller</span>
                <i
                    class="lab-close-circle-line text-xl text-red-500 transition opacity-0 -ml-8 clear-item-type-filter font-fill-danger lab-font-size-24"></i>
            </button>


            </div>

            <div v-if="Object.keys(category).length > 0" class="flex gap-4 items-center justify-between mb-6">
                <h2 class="capitalize text-[26px] leading-[40px] font-semibold text-center sm:text-left">
                    {{ category.name }}
                </h2>
                <div class="flex items-center gap-3">
                    <button type="button" class="lab lab-element-3 lab-font-size-20 text-xl filter-button"
                        v-on:click="itemProps.property.design = enums.itemDesignEnum.GRID"
                        :class="itemProps.property.design === enums.itemDesignEnum.GRID ? 'text-heading' : 'text-[#A0A3BD]'"></button>
                    <button type="button" class="lab lab-row-vertical lab-font-size-20 text-xl filter-button"
                        v-on:click="itemProps.property.design = enums.itemDesignEnum.LIST"
                        :class="itemProps.property.design === enums.itemDesignEnum.LIST ? 'text-heading' : 'text-[#A0A3BD]'"></button>

                </div>
            </div>

            <ItemComponent @addToCartEvent="handleAddToCart" :items="items" :type="itemProps.property.type"
                :design="itemProps.property.design" />
        </div>
    </section>



    <div v-if="Object.keys(order).length > 0" ref="confirmOrder" id="confirm-order"
        class="modal confirm-order ff-modal">
        <div class="modal-dialog max-w-[360px] relative">
            <button class="modal-close fa-regular fa-circle-xmark absolute top-5 right-5"
                @click.prevent="closeModal"></button>
            <div class="modal-body">
                <h3 class="capitalize text-base font-medium text-center mt-2 mb-3">
                    {{ $t('message.order_thank_you') }}
                </h3>
                <img class="w-[120px] mx-auto mb-3" :src="setting.image_confirm" alt="gif">
                <h3 class="capitalize text-lg font-medium text-center mb-3 text-primary">
                    {{ $t('label.order_confirmed') }}
                </h3>
                <p class="text-sm leading-6 mb-4">
                    {{ $t('message.order_confirm') }}
                    <b class="font-medium">{{
                        $t('label.dining_table') }}.
                    </b>
                    <strong class="font-normal"
                        v-if="setting.site_online_payment_gateway === enums.activityEnum.ENABLE && order.transaction === null && order.payment_status === enums.paymentStatusEnum.UNPAID && paymentMethod === 'digitalPayment'">
                        {{ $t('message.choosing_payment_options') }}
                    </strong>
                </p>

                <div class="flex gap-6"
                    v-if="setting.site_online_payment_gateway === enums.activityEnum.ENABLE && order.transaction === null && order.payment_status === enums.paymentStatusEnum.UNPAID && paymentMethod === 'digitalPayment'">
                    <router-link @click.prevent="closeModal"
                        class="w-full rounded-3xl text-center font-medium leading-6 py-3 border border-primary text-primary bg-white"
                        :to="{ name: 'table.tableOrder.details', params: { slug: this.$route.params.slug, id: order.id } }">
                        {{ $t('button.go_to_order') }}
                    </router-link>
                    <a :href="'/payment/' + order.id + '/pay'"
                        class="w-full rounded-3xl text-center font-medium leading-6 py-3 text-white bg-primary">
                        {{ $t('button.pay_now') }}
                    </a>
                </div>

                <router-link v-else @click.prevent="closeModal"
                    class="w-full rounded-3xl text-center font-medium leading-6 py-3 text-white bg-primary"
                    :to="{ name: 'table.tableOrder.details', params: { slug: this.$route.params.slug, id: order.id } }">
                    {{ $t('button.go_to_order') }}
                </router-link>

            </div>
        </div>
    </div>


    <div class="fixcart" v-if="subtotal">
        <div class="flexview">
            <div :class="['flexview11', { 'bg-gif': showGif }]">

                <div class="flexview1 ">
                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_356_1276)">
                            <path
                                d="M8.25732 1.65506C8.61372 1.69172 9.18411 1.74632 9.75373 1.81028C10.4774 1.8914 11.1101 1.68392 11.6867 1.24633C12.1116 0.923407 12.5295 0.589563 12.9862 0.309539C13.6788 -0.114006 14.3589 -0.0984057 15.0429 0.325139C15.4569 0.581762 15.8499 0.870366 16.2219 1.18003C16.9526 1.78844 17.7805 1.90232 18.6863 1.77518C19.2419 1.69718 19.7975 1.59499 20.3671 1.66832C20.8504 1.72994 21.2255 1.95224 21.5118 2.3399C21.7694 2.68701 21.9266 3.08481 22.1001 3.47482C22.206 3.71428 22.3071 3.95608 22.4098 4.19711C22.69 4.85465 23.1623 5.31642 23.8214 5.5941C24.2588 5.77897 24.6969 5.96539 25.1249 6.17131C26.1217 6.65102 26.4462 7.25318 26.3271 8.35222C26.2742 8.8444 26.226 9.33815 26.1785 9.83111C26.1147 10.491 26.2937 11.0791 26.6952 11.6049C26.9364 11.9215 27.1722 12.2429 27.4057 12.5658C28.1971 13.6617 28.1986 14.3349 27.4111 15.4246C27.2181 15.6921 27.0314 15.9674 26.8174 16.2178C26.2003 16.9409 26.0812 17.7755 26.2182 18.6811C26.275 19.0555 26.3131 19.433 26.3442 19.8106C26.4158 20.6834 26.0945 21.3519 25.2906 21.7442C24.8548 21.9564 24.4144 22.1623 23.9638 22.3393C23.1647 22.6537 22.6277 23.2059 22.318 24.0047C22.1499 24.4384 21.9624 24.8674 21.7476 25.2792C21.3048 26.131 20.6963 26.443 19.7392 26.3455C19.2372 26.294 18.7346 26.2425 18.2326 26.1887C17.5315 26.1138 16.9098 26.2995 16.3518 26.73C15.9752 27.021 15.5876 27.2979 15.2001 27.574C14.4126 28.1348 13.6166 28.145 12.8228 27.5865C12.4812 27.3462 12.1326 27.113 11.8143 26.8431C11.0743 26.2144 10.2253 26.0826 9.29928 26.2261C8.92576 26.2839 8.54757 26.3229 8.17016 26.3517C7.32352 26.4165 6.66519 26.1068 6.27844 25.3276C6.05822 24.8845 5.84967 24.4345 5.66913 23.9742C5.35475 23.1755 4.80615 22.6342 4.00697 22.3245C3.59143 22.1638 3.18211 21.9813 2.78525 21.7793C1.8709 21.3152 1.55341 20.7037 1.66546 19.6904C1.72071 19.1881 1.76974 18.6858 1.82032 18.1827C1.88724 17.5126 1.70437 16.9152 1.29817 16.3809C1.04527 16.0486 0.795475 15.7132 0.552687 15.3731C-0.181903 14.3458 -0.182681 13.6571 0.546461 12.6337C0.744116 12.3568 0.937879 12.0752 1.1581 11.817C1.78764 11.0799 1.91993 10.2328 1.78141 9.30305C1.70282 8.77654 1.61955 8.2477 1.66546 7.70871C1.71838 7.0925 2.03198 6.66038 2.54635 6.34915C3.05527 6.04183 3.61555 5.84293 4.15716 5.60736C4.84428 5.30862 5.32051 4.82813 5.61622 4.14017C5.8341 3.63238 6.03098 3.11523 6.29867 2.62851C6.67919 1.93742 7.25893 1.61059 8.25809 1.65506H8.25732Z"
                                fill="#E52B50" />
                            <path
                                d="M7.33654 13.4786C7.35755 12.8249 7.65793 12.3398 8.25634 12.08C8.86564 11.8156 9.44071 11.924 9.93017 12.3756C10.2874 12.7048 10.6212 13.0589 10.9651 13.4029C11.4741 13.9115 11.9939 14.4099 12.4857 14.9341C12.6787 15.14 12.7798 15.1018 12.9572 14.9231C14.628 13.2391 16.3057 11.5621 17.985 9.88663C18.5624 9.31098 19.3569 9.21348 19.9755 9.62922C20.7895 10.1752 20.9015 11.2914 20.2028 12.0106C19.6269 12.6034 19.0363 13.1814 18.4527 13.7664C16.9407 15.2796 15.4295 16.7928 13.9167 18.3045C13.1323 19.0892 12.3036 19.0923 11.5254 18.3146C10.2944 17.0846 9.06563 15.8521 7.83379 14.6228C7.5163 14.3062 7.3311 13.9372 7.33654 13.4794V13.4786Z"
                                fill="white" />
                        </g>
                        <defs>
                            <clipPath id="clip0_356_1276">
                                <rect width="28" height="28" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>
                    <!--<div class="contentview">
                        <h5>
                            {{
                                currencyFormat(
                                    subtotal,
                                    setting.site_digit_after_decimal_point,
                                    setting.site_default_currency_symbol,
                                    setting.site_currency_position
                                )
                            }}
                        </h5>
                        <p>Extra charges may apply</p>
                    </div>-->

                    <h6>{{ carts.length }} items in cart</h6>
                </div>

                <div class="footerright">
                    <!--<h6>{{ carts.length }} items in cart</h6>-->

                    <router-link
                        :to="{ name: 'table.checkout', params: { slug: this.$route.params.slug } }"
                        class="webcart1 btn btn-primary">
                        {{ $t('button.proceed_checkout') }}
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import LoadingComponent from "../../table/components/LoadingComponent.vue";
import statusEnum from "../../../enums/modules/statusEnum";
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel';
import ItemComponent from "../components/ItemComponent.vue";
import itemDesignEnum from "../../../enums/modules/itemDesignEnum";
import itemTypeEnum from "../../../enums/modules/itemTypeEnum";
import orderTypeEnum from "../../../enums/modules/orderTypeEnum";
import activityEnum from "../../../enums/modules/activityEnum";
import paymentStatusEnum from "../../../enums/modules/paymentStatusEnum";
import appService from "../../../services/appService";

export default {
    name: "TableMenuComponent",
    components: {
        ItemComponent,
        LoadingComponent,
        Carousel,
        Slide,
        Pagination,
        Navigation,
    },
    data() {
        return {
            showGif: false,
            loading: {
                isActive: false,
            },
            category: {
                id: 0,
                name: this.$t('label.all') + ' ' + this.$t('label.items')
            },
            categoryProps: {
                search: {
                    paginate: 0,
                    order_column: "sort",
                    order_type: "asc",
                    status: statusEnum.ACTIVE
                },
            },
            bannerProps: {
                search: {
                    paginate: 0,
                    order_column: "id",
                    order_type: "asc",
                    status: statusEnum.ACTIVE
                },
            },
            settings: {
                itemsToShow: 8,
                wrapAround: false,
                snapAlign: "start"
            },
            bannerSettings: {
                itemsToShow: 1,
                autoplay: 2000,
                transition: 300,
                wrapAround: true,
                snapAlign: "start",
            },
            breakpoints: {
                // 200px and up
                200: {
                    itemsToShow: 1.1,
                    wrapAround: false,
                    snapAlign: 'start',
                },
                // 250px and up
                250: {
                    itemsToShow: 1.5,
                    wrapAround: false,
                    snapAlign: 'start',
                },
                // 300px and up
                300: {
                    itemsToShow: 3.5,
                    wrapAround: false,
                    snapAlign: 'start',
                },
                // 375px and up
                375: {
                    itemsToShow: 3.5,
                    wrapAround: false,
                    snapAlign: 'start',
                },
                540: {
                    itemsToShow: 3.5,
                    wrapAround: false,
                    snapAlign: 'start',
                },
                // 700px and up
                700: {
                    itemsToShow: 4.5,
                    wrapAround: false,
                    snapAlign: 'start',
                },
                // 1024 and up
                1024: {
                    snapAlign: 'start',
                    itemsToShow: 7,
                    wrapAround: false,
                },
                // 1180 and up
                1180: {
                    snapAlign: 'start',
                    itemsToShow: 8,
                    wrapAround: false,
                }
            },
            itemProps: {
                search: {
                    paginate: 0,
                    order_column: "id",
                    order_type: "asc",
                    item_category_id: "",
                    status: statusEnum.ACTIVE
                },
                property: {
                    design: itemDesignEnum.LIST,
                    type: null
                }
            },
            enums: {
                activityEnum: activityEnum,
                paymentStatusEnum: paymentStatusEnum,
                itemTypeEnum: itemTypeEnum,
                itemDesignEnum: itemDesignEnum,
                orderTypeEnumArray: {
                    [orderTypeEnum.DELIVERY]: this.$t("label.delivery"),
                    [orderTypeEnum.TAKEAWAY]: this.$t("label.takeaway"),
                    [orderTypeEnum.DINING_TABLE]: this.$t("label.dining_table")
                },
            }
        }
    },
    computed: {
        categories: function () {
            return this.$store.getters["tableItemCategory/lists"];
        },
        items: function () {
            return this.$store.getters["frontendItem/lists"];
        },
        setting: function () {
            return this.$store.getters['frontendSetting/lists'];
        },
        order: function () {
            return this.$store.getters['tableDiningOrder/show'];
        },
        paymentMethod: function () {
            return this.$store.getters['tableCart/paymentMethod'];
        },
        carts: function () {
            return this.$store.getters['tableCart/lists'];
        },
        subtotal: function () {
            return this.$store.getters["tableCart/subtotal"];
        },
        banners: function () {
            return this.$store.getters["offer/lists"];
        },
    },
    mounted() {
        this.loading.isActive = true;
        this.itemList();
        this.$store.dispatch("tableItemCategory/lists", this.categoryProps.search).then(res => {
            this.loading.isActive = false;
        }).catch((err) => {
            this.loading.isActive = false;
        });
        this.$store.dispatch("offer/lists", this.bannerProps.search).then(res => {
            this.loading.isActive = false;
        }).catch((err) => {
            this.loading.isActive = false;
        });
        if (Object.keys(this.$route.query).length > 0) {
            this.loading.isActive = true;
            this.$store.dispatch('tableDiningOrder/show', this.$route.query.id).then(res => {
                const modalTarget = this.$refs.confirmOrder;
                modalTarget?.classList?.add("active");
                document.body.style.overflowY = "hidden";
                this.loading.isActive = false;
            }).catch((err) => {
                this.loading.isActive = false;
            });
        }

    },
    methods: {
        closeModal: function () {
            const modalTarget = this.$refs.confirmOrder;
            modalTarget?.classList?.remove("active");
            document.body.style.overflowY = "auto";
            this.loading.isActive = false;
        },
        allCategory: function (category) {
            this.itemProps.search.item_category_id = "";
            this.category = {
                id: 0,
                name: category.name
            }
            this.itemList();
        },
        currencyFormat(amount, decimal, currency, position) {
            return appService.currencyFormat(
                amount,
                decimal,
                currency,
                position
            );
        },
        setCategory: function (id, slug = null) {
            this.itemProps.search.item_category_id = id;
            this.itemList();
            if (slug !== null) {
                this.loading.isActive = true;
                this.$store.dispatch("tableItemCategory/show", {
                    slug: slug
                }).then((res) => {
                    this.category = res.data.data;
                    this.loading.isActive = false;
                }).catch((err) => {
                    this.loading.isActive = false;
                });
            }
        },
        itemList: function () {
            this.loading.isActive = true;
            this.$store.dispatch("frontendItem/lists", this.itemProps.search).then((res) => {
                this.loading.isActive = false;
            }).catch((err) => {
                this.loading.isActive = false;
            });
        },
        itemTypeSet: function (e) {
            this.itemProps.property.type = e;
        },
        itemTypeReset: function () {
            this.itemProps.property.type = null;
        },
        handleAddToCart() {
            this.showGif = true;
            setTimeout(() => {
                this.showGif = false;
            }, 3000);
        }
    }
}

</script>
