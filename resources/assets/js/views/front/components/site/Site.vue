<template>
    <div>
        <!-- BASIC FILTER -->

        <!-- <div> -->
            <!-- <h5>FILTER</h5> -->
            <!-- <form @submit.prevent="doFilter()" class="ui form">
                <div class="field">
                    <label for="">Site Name</label>
                    <input type="text" v-model="filter.site_name">
                </div>
                <button class="ui button">Find</button>
            </form> -->
        <!-- </div> -->

        <!-- ADVANCED FILTER -->
        <div>
            <!-- <h5>ADVANCED</h5> -->
        </div>
        <hr>
        <!-- TABLE CONTENT -->
        
        <button class="ui primary button" @click="add=true" v-bind:class="[{ disabled: add == true }]">
            <i class="add icon"></i> 
            Add Record
        </button>
        <button class="ui button" @click="changePage(pagination.current_page)">
            <i class="sync icon"></i> Reload Data
        </button>
        <button class="ui button" @click="advanceFilter=!advanceFilter">
            Show Advanced Filter
        </button>
        <button v-bind:class="[{ disabled: checkedData == '' }]" class="ui negative button right floated" @click="deleteSelected()">
            <i class="trash icon"></i> Delete Selected
        </button>
        <button class="ui button right floated" v-if="checkedData != ''">
            <div class="ui simple dropdown item">
                <div class="text">...</div>
                <i class="dropdown icon"></i>
                <div class="menu">
                    <span v-for="data in checkedData">
                        {{ data }}
                    </span>
                </div>
            </div>
        </button>
        
        <div v-if="advanceFilter">
            <hr>
            <form @submit.prevent="advancedFilter" class="ui form">
                <div class="field">
                    <label for="">Site ID</label>
                    <input type="text" v-model="filters[0].query_1">
                </div>
                <div class="field">
                    <label for="">Site Name</label>
                    <input type="text" v-model="filters[1].query_1">
                </div>
                <div class="field">
                    <button class="ui button positive">Apply Filters</button>
                </div>
            </form>
        </div>

        <div v-bind:class="[ add == true ? 'show' : 'hide' ]">
            <hr>
            <div class="alert alert-danger" v-if="error">
                <p>Something went wrong. Please check your input!</p>
            </div>
            <div class="alert alert-success" v-if="success">
                <p>Record successfully added!</p>
            </div>
            <form @submit.prevent="addSite" class="ui form">
                <div class="field">
                    <label for="">Site ID</label>
                    <input type="text" v-model="site.site_id" v-model.trim="$v.site.site_id.$model"/>
                    <span class="alert-danger" v-if="!$v.site.site_id.required && error">The site ID field is required</span>
                    <span class="alert-danger" v-if="!$v.site.site_id.minLength && error">The site ID must have at least {{ $v.site.site_id.$params.minLength.min }} letters</span>
                </div>
                <div class="field">
                    <label for="">Site Name</label>
                    <input type="text" v-model="site.site_name" v-model.trim="$v.site.site_name.$model">
                    <span class="alert-danger" v-if="!$v.site.site_name.required && error">The site name field is required</span>
                    <span class="alert-danger" v-if="!$v.site.site_name.minLength && error">The site ID must have at least {{ $v.site.site_name.$params.minLength.min }} letters</span>                    
                </div>
                <div class="field">
                    <label for="">Type</label>
                    <select class="ui dropdown" v-model="site.site_type" v-model.trim="$v.site.site_type.$model">
                        <option value="default" selected disabled>SELECT TOWER TYPE</option>
                        <option value="tower">Tower</option>
                        <option value="telkom">Telkom</option>
                    </select>
                    <span class="alert-danger" v-if="!$v.site.site_type.required && error">The tower type field must be selected</span>
                </div>
                <!-- <div class="field">
                    <label for="">Type</label>
                    <div class="ui selection dropdown">
                    <input type="hidden" name="gender">
                        <i class="dropdown icon"></i>
                        <div class="default text">Gender</div>
                        <div class="menu">
                            <div class="item" data-value="1">Male</div>
                            <div class="item" data-value="0">Female</div>
                        </div>
                    </div>
                </div> -->
                <div class="field">
                    <label for="">Location</label>
                    <input type="text" v-model="site.lokasi" v-model.trim="$v.site.lokasi.$model">
                    <span class="alert-danger" v-if="!$v.site.lokasi.required && error">The location field is required</span>
                </div>
                <div class="field">
                    <label for="">Site Description</label>
                    <textarea cols="30" rows="10" v-model="site.description"></textarea>
                </div>
                <button class="ui button positive" v-bind:class="[{ disabled: site.site_id == '' || site.site_name == '' || site.site_type == 'default' || site.lokasi == '' }]" :disabled="submitStatus == 'PENDING'">
                    <span v-if="submitStatus === 'ERROR'">Something went wrong, please try again</span>
                    <span v-if="submitStatus === 'PENDING'">Sending...</span>
                    <span v-if="submitStatus === null || submitStatus == 'OK'">Add</span>
                </button>
                <button type="reset" class="ui button">Reset</button>
                <span class="ui button negative" v-if="add" @click="add=false">Close</span>
            </form>
            <hr>
        </div>

        <hr>
        <form action="" class="ui form">
            <div class="fields">
                <div class="three wide field">
                    <label for="">Operator</label>
                    <div class="field">
                        <select @change="doFilter()" v-model="filter.operator">
                            <option value="equal_to">Equal to (=)</option>
                            <option value="contains">Contains (%)</option>
                        </select>
                    </div>
                </div>
                <div class="field" style="width:100%">
                    <label for="">Site ID</label>
                    <input v-on:keyup="doFilter()" type="text" v-model="filter.globalSearch" placeholder="Type here to find">
                </div>
            </div>
        </form>
        <hr>
        <div>
            <select class="ui dropdown" v-model="paging.limit" :disabled="loading" @change="changeLimit">
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="25">25</option>
                <option value="50">50</option>
            </select>
            <span style="padding-left: 10px">Showing row {{ pagination.from }} to {{ pagination.to }} of {{ pagination.total }} total entries.</span>
        </div>

        <!-- <site-data></site-data> -->
        <table class="ui unstackable table">
            <thead>
                <tr v-bind:class="[ loading==false ? 'hide' : '' ]">
                    <th colspan="5">
                        <loading class="center aligned" :loading="loading" v-if="loading"></loading>
                    </th>
                </tr>
                <tr>
                    <th style="cursor: pointer" class="center aligned" @click="selectAll()">
                        <i class="check icon"></i>
                    </th>
                    <th style="cursor: pointer" @click="order('site_id')">Site ID</th>
                    <th style="cursor: pointer" @click="order('site_name')">Site Name</th>
                    <th style="cursor: pointer" @click="order('lokasi')">Location</th>
                    <th width="300">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody v-if="!loading">
                <tr v-for="site in sites" :key="site.id">
                    <td class="collapsing">
                        <div class="ui fitted checkbox">
                            <input type="checkbox" @change="updateCheckList(site.id)" :checked="!!checkedData.includes(site.id)"> <label></label>
                        </div>
                    </td>
                    <td>{{ site.site_id | highlight(filter.globalSearch) }}</td>
                    <td>{{ site.site_name | highlight(filter.globalSearch) }}</td>
                    <td>{{ site.lokasi | highlight(filter.globalSearch) }}</td>
                    <td class="center aligned">
                        <b-button @click="viewModal(site.id)" class="ui detail primary basic button">Detail</b-button>
                        <div class="ui buttons">
                            <b-button @click="editModal(site.id)" class="ui positive button">Edit</b-button>
                        <div class="or"></div>
                            <button class="ui negative button" @click="deleteSite(site.id)">Delete</button>
                        </div>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr><th colspan="5">
                <div class="ui left floated">
                    <div class="ui small basic icon buttons menu floated">
                        <button class="ui button"><i class="file word icon"></i></button>
                        <button class="ui button"><i class="file excel icon"></i></button>
                        <button class="ui button"><i class="file pdf icon"></i></button>
                        <button class="ui button"><i class="file archive icon"></i></button>
                    </div>
                </div>
                <div class="ui right floated pagination menu">
                    <li class="item">
                        Showing page {{ pagination.current_page }} of {{ pagination.last_page }}
                    </li>
                    <li :class="[{ disabled: pagination.prev_page_url == null }]" class="icon item" @click="fetchSites(pagination.prev_page_url)">
                        <i class="left chevron icon"></i>
                    </li>
                    <li v-for="page in pageNumber">
                        <a :class="[page == isActive ? 'active' : '']" @click.prevent="changePage(page)" class="item">
                            {{ page }}
                        </a>
                    </li>
                    <li v-bind:class="[{ disabled: !pagination.next_page_url }]" class="icon item" @click="fetchSites(pagination.next_page_url)">
                        <i class="right chevron icon"></i>
                    </li>
                </div>
                </th>
            </tr></tfoot>
        </table>

        <b-modal ref="detailRef" id="viewModal" size="lg" title="Record Details" hide-footer>
            <!-- <p class="my-4">Hello from modal</p> -->
            <div>
                <table class="ui unstackable table">
                    <tr>
                        <th width="200">Site ID</th>
                        <td>{{ vsites.site_id }}</td>
                    </tr>
                    <tr>
                        <th>Site Name</th>
                        <td>{{ vsites.name }}</td>
                    </tr>
                    <tr>
                        <td>Site Type</td>
                        <td>{{ vsites.type }}</td>
                    </tr>
                    <tr>
                        <th>Site Location</th>
                        <td>{{ vsites.lokasi }}</td>
                    </tr>
                    <tr>
                        <th>Site Description</th>
                        <td>{{ vsites.description == null ? '-' : vsites.description }}</td>
                    </tr>
                </table>
                <b-btn class="ui button" @click="hideModal">Close</b-btn>
            </div>
        </b-modal>

        <b-modal ref="editFormRef" id="viewModal" size="lg" title hide-footer>
            <!-- <p class="my-4">Hello from modal</p> -->
            <form @submit.prevent="saveChanges(vsite.id)" class="ui form">
                    <div class="field">
                        <label for="">Site ID</label>
                        <input type="text" v-model="vsite.site_id">
                    </div>
                    <div class="field">
                        <label for="">Site Name</label>
                        <input type="text" v-model="vsite.site_name">
                    </div>
                    <div class="field">
                        <label for="">Site Type</label>
                        <select v-model="vsite.site_type">
                            <option value="default" selected disabled>SELECT TOWER TYPE</option>
                            <option value="tower">Tower</option>
                            <option value="telkom">Telkom</option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="">Site Location</label>
                        <input type="text" v-model="vsite.lokasi">
                    </div>
                    <div class="field">
                        <label for="">Site Description</label>
                        <textarea v-model="vsite.description"></textarea>
                    </div>
                    <button class="ui button positive">Save Changes</button>
                    <b-btn class="ui button" @click="hideModal">Close</b-btn>
                </form>
        </b-modal>

    </div>
</template>

<script>

    import Data from '../site/Data'
    import { required, minLength } from 'vuelidate/lib/validators'
    import NProgress from 'nprogress'

    export default {
        created() {
            this.fetchSites();
        },
        metaInfo: {
            title: 'Site Management'
        },
        data() {
            return {
                sites: [],
                vsites: [],
                vsite: {
                    id: '',
                    site_id: '',
                    site_name: '',
                    site_type: '',
                    lokasi: '',
                    description: '',
                },
                site: {
                    site_id: '',
                    site_name: '',
                    site_type: 'default',
                    lokasi: '',
                    description: '',
                },
                filter: {
                    operator: 'equal_to',
                    site_id: '',
                    globalSearch: ''
                },
                filters: [
                    {column: 'site_id', operator: 'contains', query_1: ''},
                    {column: 'site_name', operator: 'contains', query_1: ''},
                ],
                id: '',
                pagination: {},
                paging: {
                    limit: 10
                },
                offset: 3,
                edit: false,
                checked: false,
                error: false,
                success: false,
                loading: true,
                modal: false,
                add: false,
                advanceFilter: false,
                submitStatus: null,
                title: '',
                checkedData: [],
                checkAll: false,
                orderableBy: {
                    site_id: false,
                    site_name: false,
                    lokasi: false,
                }
            }
        },
        watch: {
            filter: {
                site_name(after, before) {
                    this.fetchSites()
                }
            }
        },
        validations: {
            site: {
                site_id: {
                    required,
                    minLength: minLength(6)
                },
                site_name: {
                    required,
                    minLength: minLength(6)                
                },
                site_type: {
                    required
                },
                lokasi: {
                    required
                }
            }
        },
        computed: {
            isActive: function() {
                return this.pagination.current_page
            },
            pageNumber: function() {
                if(!this.pagination.to) {
                    return []
                }

                var from = this.pagination.current_page - this.offset
                if(from < 1) {
                    from = 1
                }

                var to = from + (this.offset * 2)
                if(to > this.pagination.last_page) {
                    to = this.pagination.last_page
                }

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from)
                    from++
                }

                return pagesArray
            }
        },
        methods: {
            fetchSites(page_url) {
                const app = this
                this.loading = true
                page_url = page_url || this.$api + 'site'
                this.axios({
                    method: 'get',
                    url: page_url
                })
                .then(res => {
                    app.sites = res.data.data
                    app.makePagination(res.data.meta, res.data.links)
                    app.loading = false
                }).catch(err => console.log(err))
                .finally(() => {
                    NProgress.done()
                })
            },
            doFilter() {
                if (this.filter.globalSearch != '') {
                    this.loading = true
                    this.axios({
                        method: 'get',
                        url: this.$api + 'site',
                        params: {
                            // 'f[0][column]': 'site_id',
                            // 'f[0][operator]': this.filter.operator,
                            // 'f[0][query_1]': this.filter.site_id,
                            'f[0][any]': this.filter.globalSearch
                        }
                    })
                    .then(res => {
                        this.sites = []
                        this.sites = res.data.data
                        this.makePagination(res.data.meta, res.data.links)
                        this.loading = false
                    })
                    .catch(err => {
                        console.log(err)
                    })
                } else {
                    this.fetchSites()
                }
            },
            advancedFilter() {

                this.filters.forEach(element => {
                    console.log(element)
                });

                const params = {
                    ...this.filters
                }

                this.axios({
                    method: 'get',
                    url: this.$api + 'site',
                    params: {
                        // this.filters.forEach(element => {
                            
                        // });
                    }
                })
                .then(res => {
                    console.log(res.data.data)
                })
                .catch(err => {
                    console.log(err)
                })
            },
            changeLimit() {
                this.loading = true
                this.axios({
                    method: 'get',
                    url: this.$api + 'site',
                    params: {
                        'limit': this.paging.limit
                    }
                })
                .then(res => {
                    this.sites = []
                    this.sites = res.data.data
                    this.makePagination(res.data.meta, res.data.links)
                    this.loading = false
                })
                .catch(err => {
                    console.log(err)
                })
            },
            order(key) {
                this.orderableBy[key] = !this.orderableBy[key]
                this.axios({
                    method: 'get',
                    url: this.$api + 'site',
                    params: {
                        'order_column': key,
                        'order_direction': this.orderableBy[key] ? 'asc' : 'desc'
                    }
                })
                .then(res => {
                    this.sites = []
                    this.sites = res.data.data
                    this.makePagination(res.data.meta, res.data.links)
                })
                .catch(err => {
                    console.log(err)
                })
            },
            addSite() {
                this.$v.$touch()
                if(this.$v.$invalid) {
                    this.submitStatus = 'ERROR'
                }
                this.submitStatus = 'PENDING'
                let app = this
                this.axios(this.$api + 'site', {
                    method: 'post',
                    body: JSON.stringify(app.site),
                    data: JSON.stringify(app.site),
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + this.$auth.token()
                    }
                })
                .then(res => {
                    this.loading = true
                    app.success = true
                    this.loading = true
                    app.site.site_id = ''
                    app.site.site_name = ''
                    app.site.site_type = 'default'
                    app.site.lokasi = ''
                    app.site.description = ''       
                    this.error = false
                    this.submitStatus = 'OK'   
                    this.fetchSites()
                })
                .catch(err => {
                    app.error = true
                    this.submitStatus = null
                })
            },
            saveChanges(id) {
                let app = this
                console.log(JSON.stringify(app.vsite))
                NProgress.start();
                this.axios({
                    method: 'put',
                    url: this.$api + `site/${id}`,
                    body: JSON.stringify(app.vsite),
                    data: JSON.stringify(app.vsite),
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + this.$auth.token(),
                    }
                })
                .then(res => {
                    this.fetchSites()
                    this.changePage(this.pagination.current_page)
                    NProgress.done()
                    this.$refs.editFormRef.hide()
                })
                .catch(err => console.log(err))
            },
            deleteSite(id) {
                this.$dialog.confirm('Are you sure want to delete this record ?')
                .then(res => {
                    this.axios({
                        method: 'delete',
                        url: this.$api + `site/${id}`,
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'Authorization': 'Bearer ' + this.$auth.token(),
                        }
                    })
                    .then(res => {
                        setTimeout(() => {
                            console.log('Delete action completed ');
                            dialog.close();
                        }, 2500)
                        this.fetchSites()
                        this.changePage(this.pagination.current_page)
                    })
                    .catch(err => alert('Error ' + err))
                })
                .catch(err => {
                    console.log(err)
                })
            },
            makePagination(meta, links) {
                let pagination = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next_page_url: links.next,
                    prev_page_url: links.prev,
                    from: meta.from,
                    to: meta.to,
                    total: meta.total,
                    per_page: meta.per_page,
                }

                this.pagination = pagination
            },
            changePage(page) {
                this.pagination.current_page = page  
                this.fetchSites(this.$api + 'site/?page=' + page)
            },
            viewModal(id) {
                NProgress.start()
                this.$refs.detailRef.show()
                this.axios({
                    method: 'get',
                    url: this.$api + `site/${id}`,
                })
                .then(res => {
                    this.vsites = res.data
                    NProgress.done()
                })
            },
            editModal(id) {
                let app = this
                NProgress.start()
                this.$refs.editFormRef.show()
                this.axios({
                    method: 'get',
                    url: this.$api + `site/${id}`,
                })
                .then(res => {
                    app.title = res.data.site_id
                    // app.vsite = res.data
                    app.vsite.id = res.data.id
                    app.vsite.site_id = res.data.site_id 
                    app.vsite.site_name = res.data.name
                    app.vsite.site_type = res.data.type
                    app.vsite.lokasi = res.data.lokasi 
                    app.vsite.description = res.data.description
                    NProgress.done()
                })
                .catch(err => console.log(err))
            },
            hideModal() {
                this.$refs.detailRef.hide()
                this.$refs.editFormRef.hide()
                // this.vsite = []
            },
            updateCheckList(id) {
                this.checkAll = false
                if(this.checkedData.includes(id)) {
                    let index = this.checkedData.indexOf(id)
                    this.checkedData.splice(index, 1)
                } else {
                    this.checkedData.push(id)
                }
                console.log("Current selected objects : " + this.checkedData)
                $("div.message-success").fadeIn(300).delay(300).fadeOut(400)
            },
            inArray(id) {
                return this.checkedData.indexOf(id) > -1
            },
            deleteSelected() {
                this.$dialog.confirm('Are you sure want to delete this ' + (this.checkedData.length > 1 ? 'records' : 'record') + ' ?')
                .then(res => {
                    NProgress.start()
                    let selectedData = this.checkedData
                    this.axios({
                        url: 'site/delete-selected',
                        method: 'delete',
                        params: {
                            'id': selectedData
                        }
                    })
                    .then(res => {
                        setTimeout(() => {
                            dialog.close();
                        }, 2500)
                        this.fetchSites()
                        this.changePage((this.pagination.current_page != '' ? this.pagination.current_page : this.pagination.last_page))
                        console.log(this.pagination.current_page)
                        this.checkedData = []
                        NProgress.done()
                    })
                    .catch(err => {
                        console.log(err)
                    })
                })
            },
            selectAll() {
                this.checkAll = !this.checkAll
                this.axios({
                    method: 'get',
                    url: this.$api + 'site',
                    params: {
                        'limit': this.pagination.total
                    }
                })
                .then(res => {
                    this.vsites = []
                    this.vsites = res.data.data
                    // this.makePagination(res.data.meta, res.data.links)
                    this.vsites.forEach(value => {
                        // console.log(value.id)
                        if(this.checkAll) {
                            this.checkedData.push(value.id)
                        } else {
                            this.checkedData = []
                        }
                    });
                })
                .catch(err => {
                    console.log(err)
                })
            }
        },
        components: {
            siteData: Data
        },
        filters: {
            highlight(word, query) {
                var iQuery = new RegExp(query, 'ig')
                return word.toString().replace(query, function(matchedText, a, b) {
                    return ('<span style="color:#ff0000">' + matchedText + '</span>')
                })
            }
        }
    }

</script>

<style>

</style>
