<template>
    <LoadingComponent :props="loading" />
    <section class=" pb-16 bgorder">
        <div class="container-fluid">
            <div class="order-header pt-8 ">
                <router-link :to="{ name: 'table.checkout', params: { slug: this.$route.params.slug } }"
                    class="text-xs pl-4 font-medium inline-flex mb-3 items-center gap-2 ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="16" viewBox="0 0 18 16" fill="none">
                        <path
                            d="M7.5 15.5L8.5575 14.4425L2.8725 8.75H18V7.25H2.8725L8.5575 1.5575L7.5 0.5L0 8L7.5 15.5Z"
                            fill="black" />
                    </svg>
                    <h3>{{ $t('label.back_to_home') }}</h3>
                </router-link>
            </div>
        </div>
        <div class="container max-w-[965px] pt-2">

            <div class="row">
                <div class="col-12 md:col-7">
                    <div class="mb-4 rounded-2xl shadow-xs bg-white p-2 main-ticket">
                            <div v-for="cart in carts"
                                class="mb-3 pb-3 border-b  last:mb-0 last:pb-0 last:border-b-0 border-gray-2">
                                <div class="ticket_left">
                                    <div class="rotate">
                                        <div>
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M10.0001 2.70917L8.41007 1.78917C8.21877 1.6786 7.99139 1.64853 7.77793 1.70556C7.56446 1.7626 7.38238 1.90208 7.27174 2.09333L6.35174 3.685H4.5184C4.29739 3.685 4.08543 3.7728 3.92915 3.92908C3.77287 4.08536 3.68507 4.29732 3.68507 4.51834L3.68507 6.35083L2.09423 7.27C1.90333 7.38101 1.76382 7.56273 1.7059 7.77584C1.67725 7.88153 1.66986 7.99186 1.68416 8.10044C1.69847 8.20901 1.73418 8.31367 1.78924 8.40833L2.70923 10L1.7884 11.5917C1.6779 11.7831 1.64795 12.0105 1.70515 12.224C1.76235 12.4375 1.90201 12.6195 2.0934 12.73L3.68507 13.65L3.68507 15.4825C3.68507 15.7035 3.77287 15.9155 3.92915 16.0718C4.08543 16.228 4.29739 16.3158 4.5184 16.3158H6.3509L7.2709 17.9075C7.32553 18.0025 7.39839 18.0857 7.48529 18.1524C7.57219 18.2192 7.67141 18.2681 7.77727 18.2963C7.88312 18.3246 7.99352 18.3317 8.10212 18.3171C8.21071 18.3026 8.31537 18.2668 8.41007 18.2117L10.0001 17.2917L11.5901 18.2117C11.7815 18.3217 12.0088 18.3515 12.2221 18.2947C12.4355 18.2379 12.6178 18.099 12.7292 17.9083L13.6492 16.3167L15.4817 16.3167C15.7027 16.3167 15.9147 16.2289 16.071 16.0726C16.2273 15.9163 16.3151 15.7043 16.3151 15.4833V13.65L17.9067 12.73C18.0329 12.6562 18.1376 12.5509 18.2106 12.4244C18.2837 12.2978 18.3226 12.1544 18.3234 12.0083C18.3234 11.8633 18.2851 11.7192 18.2109 11.5908L17.2909 10.0008L18.2109 8.40917C18.3212 8.21782 18.3512 7.99051 18.2942 7.77711C18.2372 7.56371 18.0978 7.38164 17.9067 7.27083L16.3151 6.35167V4.51917C16.3151 4.29815 16.2273 4.08619 16.071 3.92991C15.9147 3.77363 15.7027 3.68583 15.4817 3.68583H13.6492L12.7292 2.09417C12.6744 1.99936 12.6015 1.91628 12.5146 1.84967C12.4277 1.78307 12.3285 1.73424 12.2227 1.706C12.1169 1.67775 12.0066 1.67063 11.898 1.68504C11.7895 1.69946 11.6848 1.73512 11.5901 1.79L10.0001 2.70917ZM5.82507 12.0842C5.82518 11.7525 5.95703 11.4345 6.1916 11.2001C6.42618 10.9657 6.74427 10.8341 7.0759 10.8342C7.40753 10.8343 7.72554 10.9661 7.95996 11.2007C8.19438 11.4353 8.32601 11.7534 8.3259 12.085C8.32579 12.4166 8.19395 12.7346 7.95937 12.9691C7.72479 13.2035 7.4067 13.3351 7.07507 13.335C6.74344 13.3349 6.42543 13.203 6.19101 12.9685C5.95659 12.7339 5.82496 12.4158 5.82507 12.0842ZM13.8251 11.8342L12.8259 13.1675L6.15924 8.1675L7.1584 6.83417L13.8251 11.8342ZM14.1584 7.9175C14.1583 8.08171 14.1259 8.2443 14.0631 8.39598C14.0002 8.54767 13.908 8.68548 13.7919 8.80156C13.6757 8.91763 13.5378 9.00969 13.3861 9.07248C13.2344 9.13527 13.0718 9.16756 12.9076 9.1675C12.7434 9.16745 12.5808 9.13505 12.4291 9.07216C12.2774 9.00927 12.1396 8.91712 12.0235 8.80097C11.9074 8.68482 11.8154 8.54694 11.7526 8.39521C11.6898 8.24349 11.6575 8.08088 11.6576 7.91667C11.6577 7.58504 11.7895 7.26703 12.0241 7.03261C12.2587 6.79819 12.5768 6.66656 12.9084 6.66667C13.24 6.66678 13.558 6.79862 13.7925 7.0332C14.0269 7.26778 14.1585 7.58587 14.1584 7.9175Z"
                                                    fill="#040D12" />
                                            </svg>
                                        </div>
                                        <h3 class=""> DISCOUNT</h3>

                                    </div>
                                </div>
                            </div>
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
import IsAdvanceOrderEnum from "../../../enums/modules/isAdvanceOrderEnum";
import router from "../../../router";
import alertService from "../../../services/alertService";

export default {
    name: "CouponComponent",
    components: { LoadingComponent },
    data() {
        return {
            loading: {
                isActive: false,
            },
            placeOrderShow: false,
        }
    },
    mounted() {

    },
    computed: {

    },
    methods: {

    }

}
</script>
