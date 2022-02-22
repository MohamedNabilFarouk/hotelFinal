<template>
    <div>
        <h4 v-if="!user" class="text-capitalize py-5 text-center text-muted">
            You need to login to view this content. Please Login.
        </h4>
        <div v-if="user" class="user-profile container-fluid py-5">
            <div class="container page-blog product-detail">
                <div class="row">
                    <div id="content" class="col-md-12 col-sm-12 col-xs-12">
                        <a href="javascript:void(0)" class="open-sidebar hidden-lg hidden-md">
                            <i class="fa fa-bars"></i>Sidebar
                        </a>
                        <div class="blog-listitem list clearfix">
                            <ul class="nav border-0 justify-content-center nav-tabs" style="position: sticky; top:64px">
                                <li class="nav-item">
                                    <button
                                        @click="switchProfileTabs('profile')"
                                        :class="profile === 'profile' ? 'active': ''"
                                        class="nav-link py-4">
                                        <i class="fa fa-cogs mr-2"></i>Profile Sitting
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button
                                        @click="switchProfileTabs('booking')"
                                        :class="profile === 'booking' ? 'active': ''"
                                        class="nav-link py-4">
                                        <i class="fa fa-book mr-1"></i>
                                        Booking History
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button
                                        @click="switchProfileTabs('changePassword')"
                                        :class="profile === 'changePassword' ? 'active': ''"
                                        class="nav-link py-4">
                                        <i class="fa fa-lock mr-1"></i>
                                        Change Password
                                    </button>
                                </li>
                            </ul>

                            <div v-if="profile === 'profile'">
                                userProfile
                            </div>

                            <div v-if="profile === 'booking'">
                                Booking History
                            </div>

                            <div v-if="profile === 'changePassword'">
                                Change Password
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
import Form from "vform";
import { mapGetters } from 'vuex';
export default {
    name: 'Profile',
    components:{ },
    computed: {
        ...mapGetters([
            'user'
        ])
    },
    data(){
        return{
            profile: "profile",
            userProfile: {},
            userProfileForm: new Form({

            })
        }
    },
    watch:{
      user: function (user) {
          if (user){
              axios.get('user/edit/'+user.id).then((res) => {
                  if (res.data.success === 'true') {
                      this.userProfile = res.data.data && res.data.data.user ? res.data.data.user : {};
                  }
              }).catch();
          }
      }
    },
    mounted() {
        if (this.user){
            axios.get('user/edit/'+this.user.id).then((res) => {
                if (res.data.success === 'true') {
                    this.userProfile = res.data.data && res.data.data.user ? res.data.data.user : {};
                }
            }).catch();
        }
    },
    methods: {
        switchProfileTabs(tab){
            this.profile = tab ? tab : 'profile';
        }
    }
}
</script>
