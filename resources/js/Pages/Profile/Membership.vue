<template>
    <Head title="Profile" />

    <MainLayout>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div v-if="!showUpdateForm"  class="p-6 bg-white border-b border-gray-200">
                        Here is your profile, {{ $page.props.profileData.fullname }}!
                    </div>

                    <div v-else class="p-6 bg-white border-b border-gray-200">
                        Update your profile here!
                    </div>


                        <div class="p-6 bg-white border-b border-gray-200 flex justify-end">
                            <Button
                                type="button"
                                @click="showUpdateForm = !showUpdateForm"
                                class="btn btn-secondary"
                                >
                                Edit Profile
                            </Button>
                            <Button
                                type="button"
                                @click="$refs.fileInput.$refs.input.click()"
                                class="btn btn-accent"
                            >Change Photo</Button>
                        </div>

                    <div class="grid  grid-cols-1 lg:grid-cols-8 p-6">
                        <div class="profile-photo-box lg:col-span-2 mb-6">
                            <template v-if="$page.props.profileData.profile_photo_url">
                                <img :src="$page.props.profileData.profile_photo_url" />
                            </template>
                            <template v-else>
                                <img src="https://via.placeholder.com/250" />
                            </template>

                            <form @submit.prevent="submit" v-show="false">
                                <Input
                                    @change="onFileSelect"
                                    ref="fileInput"
                                    id="image" type="file" class="mt-1 block w-full" name="image" />
                            </form>
                        </div>

                        <template v-if="!showUpdateForm">
                            <div class="lg:col-span-offset-3 lg:col-span-5">
                                <div class="lg:ml-9">
                                    <p>
                                        <span class="font-bold">Full Name:</span>
                                        {{ $page.props.profileData.fullname }}
                                    </p>
                                    <p>
                                        <span class="font-bold">IC Number:</span>
                                        {{ $page.props.profileData.ic_number }}
                                    </p>
                                    <p>
                                        <span class="font-bold">Address:</span>
                                        {{ $page.props.profileData.address1 }}
                                    </p>
                                    <p>
                                        <span class="font-bold">Address:</span>
                                        {{ $page.props.profileData.address2 }}
                                    </p>
                                    <p>
                                        <span class="font-bold">Postcode:</span>
                                        {{ $page.props.profileData.postcode }}
                                    </p>
                                    <p>
                                        <span class="font-bold">City:</span>
                                        {{ $page.props.profileData.city }}
                                    </p>
                                    <p>
                                        <span class="font-bold">State:</span>
                                        {{ $page.props.profileData.state }}
                                    </p>
                                    <p>
                                        <span class="font-bold">Email:</span>
                                        {{ $page.props.auth.user.email }}
                                    </p>
                                    <p>
                                        <span class="font-bold">Mobile No.:</span>
                                        {{ $page.props.profileData.mobile_number ?? '---' }}
                                    </p>
                                    <p>
                                        <span class="font-bold">Employer:</span>
                                        {{ $page.props.profileData.employment }}
                                    </p>
                                    <p>
                                        <span class="font-bold">Employer Address:</span>
                                        {{ $page.props.profileData.company_address }}
                                    </p>
                                </div>
                            </div>
                        </template>
                        <template v-else>
                            <div class="lg:col-span-offset-3  lg:col-span-5">
                                <div class="lg:ml-9">
                                    <form @submit.prevent="submit">
                                        <div>
                                            <Label for="fullname" value="fullname" />
                                            <Input id="fullname" type="text" class="mt-1 block w-full" name="fullname" :modelValue="$page.props.profileData.fullname" v-model="form.fullname" required autofocus />
                                            <InputError class="mt-1" :message="$page.props.errors.fullname" />
                                        </div>
                                        <div class="mt-4">
                                            <Label for="ic_number" value="IC Number" />
                                            <Input id="ic_number" type="text" class="mt-1 block w-full" name="ic_number" :modelValue="$page.props.profileData.ic_number" v-model="form.ic_number" required autofocus autocomplete="ic_number" />
                                            <InputError class="mt-1" :message="$page.props.errors.ic_number" />
                                        </div>
                                        <div class="mt-4">
                                            <Label for="address1" value="Address" />
                                            <Input id="address1" type="text" class="mt-1 block w-full" name="address1" :modelValue="$page.props.profileData.address1" v-model="form.address1" required autofocus autocomplete="address1" />
                                            <InputError class="mt-1" :message="$page.props.errors.address1" />
                                        </div>
                                        <div class="mt-4">
                                            <Label for="address2" value="Address" />
                                            <Input id="address2" type="text" class="mt-1 block w-full" name="address2" :modelValue="$page.props.profileData.address2" v-model="form.address2" required autofocus autocomplete="address2" />
                                            <InputError class="mt-1" :message="$page.props.errors.address2" />
                                        </div>
                                        <div class="mt-4">
                                            <Label for="postcode" value="Postcode" />
                                            <Input id="postcode" type="text" class="mt-1 block w-full" name="postcode" :modelValue="$page.props.profileData.postcode" v-model="form.postcode" required autofocus autocomplete="postcode" />
                                            <InputError class="mt-1" :message="$page.props.errors.postcode" />
                                        </div>

                                        <div class="mt-4">
                                            <Label for="city" value="City" />
                                            <Input id="city" type="text" class="mt-1 block w-full" name="city" :modelValue="$page.props.profileData.city" v-model="form.city" required autofocus autocomplete="city" />
                                            <InputError class="mt-1" :message="$page.props.errors.city" />
                                        </div>


                                        <div class="mt-4">
                                            <Label for="state" value="State" />
                                            <Input id="state" type="text" class="mt-1 block w-full" name="state" :modelValue="$page.props.profileData.state" v-model="form.state" required autofocus autocomplete="state" />
                                            <InputError class="mt-1" :message="$page.props.errors.state" />
                                        </div>

                                        <div class="mt-4">
                                            <Label for="email" value="Email" />
                                            <Input id="email" type="email" class="mt-1 block w-full" name="email" :modelValue="$page.props.auth.user.email" v-model="form.email" required autofocus autocomplete="email" />
                                            <InputError class="mt-1" :message="$page.props.errors.email" />
                                        </div>

                                        <div class="mt-4">
                                            <Label for="mobilenum" value="Mobile Number" />
                                            <Input id="mobilenum" type="text" class="mt-1 block w-full" name="mobile_number" :modelValue="$page.props.profileData.mobile_number" v-model="form.mobile_number" autofocus autocomplete="mobile_number" />
                                            <InputError class="mt-1" :message="$page.props.errors.mobile_number" />
                                        </div>

                                         <div class="mt-4">
                                            <Label for="employment" value="Employment" />
                                            <Input id="employment" type="text" class="mt-1 block w-full" name="employment" :modelValue="$page.props.profileData.employment" v-model="form.employment" required autofocus autocomplete="employment" />
                                            <InputError class="mt-1" :message="$page.props.errors.employment" />
                                        </div>

                                         <div class="mt-4">
                                            <Label for="company_address" value="Company Address" />
                                            <Input id="company_address" type="text" class="mt-1 block w-full" name="company_address" :modelValue="$page.props.profileData.company_address" v-model="form.company_address" required autofocus autocomplete="company_address" />
                                            <InputError class="mt-1" :message="$page.props.errors.company_address" />
                                        </div>
                                        <div class="mt-4 flex flex-row-reverse">
                                            <Button @click="updateProfile" type="button" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                                                class="btn btn-primary"
                                            >Save Profile
                                            </Button>
                                            <Button @click="showUpdateForm = !showUpdateForm" type="button" class="mr-3 btn-secondary" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Cancel</Button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
    </MainLayout>
</template>
<style scoped>
.profile-photo-box {
    /* max-height: 250px; */
    height: auto;
    max-width: 250px;
    width: 100%;
}
</style>

<script>
import MainLayout from '@/Layouts/Authenticated.vue'
import Button from '@/Components/Button.vue'
import { Head, Link } from '@inertiajs/inertia-vue3'
import Label from '@/Components/Label.vue'
import Input from '@/Components/Input.vue'
import InputError from '@/Components/InputError.vue'
import Image from '@/Components/Image.vue'

export default {
    components: {
        MainLayout,
        Head,
        Button,
        Link,
        Label,
        Input,
        InputError,
        Image
    },
    data() {
        return {
            selectedImage: null,
            showUpdateForm: false,
            form: this.$inertia.form({
                fullname: '',
                ic_number: '',
                address1: '',
                address2: '',
                postcode: '',
                city: '',
                state: '',
                email: '',
                mobile_number: '',
                employment: '',
                company_address: '',
            }),
            formUpload: this.$inertia.form({
                image: ''
            })
        }
    },

    methods: {
        updateProfile(event) {
            let {
                fullname,
                ic_number,
                address1,
                address2,
                postcode,
                city,
                state,
                email,
                mobile_number,
                employment,
                company_address
            } = event.target.form.elements;

            this.form.fullname = fullname.value ?? '';
            this.form.ic_number = ic_number.value ?? '';
            this.form.address1 = address1.value ?? '';
            this.form.address2 = address2.value ?? '';
            this.form.postcode = postcode.value ?? '';
            this.form.city = city.value ?? '';
            this.form.state = state.value ?? '';
            this.form.email = email.value ?? '';
            this.form.mobile_number = mobile_number.value ?? '';
            this.form.employment = employment.value ?? '';
            this.form.company_address = company_address.value ?? '';

            this.form.put(this.route('update.profile', this.$page.props.auth.user.id), {
                onFinish: () => {
                    this.showUpdateForm = false;
                    this.$toast.success(this.$page.props.flash.content.message, {
                        position: 'top'
                    });
                },
            });
        },
        onFileSelect(event) {
            this.selectedImage = event.target.files[0];
            this.uploadImage()
        },
        uploadImage() {
            this.formUpload.image = this.selectedImage;

            this.formUpload.post(this.route('upload.image', this.$page.props.auth.user.id), {
                onFinish: () => {
                    this.formUpload.image = null
                    this.$toast.success(this.$page.props.flash.content.message, {
                        position: 'top'
                    });
                }
            });
        }
    }
}
</script>
