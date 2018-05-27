<template>
    <div>
        <!-- BASIC FILTER -->
        <div>
            <!-- <h5>FILTER</h5> -->
            <form action="" class="ui form">
                <div class="field">
                    <label for="">Site Name</label>
                    <input type="text" name="site_name">
                </div>
                <button class="ui button">Find</button>
            </form>
        </div>

        <!-- ADVANCED FILTER -->
        <div>
            <!-- <h5>ADVANCED</h5> -->
        </div>
        <hr>
        <!-- TABLE CONTENT -->
        <button class="ui primary button" @click="addModal()">
            <i class="add icon"></i> Add Record
        </button>
        <button class="ui button" @click="fetchSites(pagination.current_page)">
            <i class="sync icon"></i> Reload Data
        </button>
        <button v-bind:class="[{ disabled: !checked == true }]" class="ui negative button right floated" @click="fetchSites(pagination.current_page)">
            <i class="trash icon"></i> Delete Selected
        </button>

        <table class="ui unstackable table">
            <thead>
                <tr>
                    <!-- <th class="center aligned">
                        <i class="check icon"></i>
                    </th> -->
                    <th>Site ID</th>
                    <th>Site Name</th>
                    <th>Location</th>
                    <th width="300">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="site in sites" v-bind::key="site.id">
                    <!-- <td class="collapsing">
                        <div class="ui fitted checkbox">
                            <input type="checkbox" @click="toggleChecked()"> <label></label>
                        </div>
                    </td> -->
                    <td>{{ site.site_id }}</td>
                    <td>{{ site.name }}</td>
                    <td>{{ site.lokasi }}</td>
                    <td class="center aligned">
                        <button @click="showModal=true" class="ui detail primary basic button">Detail</button>
                        <div class="ui buttons">
                            <button class="ui positive button">Edit</button>
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
                    <li v-bind:class="[{ disabled: !pagination.prev_page_url }]" class="icon item" @click="fetchSites(pagination.prev_page_url)">
                        <i class="left chevron icon"></i>
                    </li>
                        <li class="item">
                            Page {{ pagination.current_page }} of {{ pagination.last_page }}
                        </li>
                    <li v-bind:class="[{ disabled: !pagination.next_page_url }]" class="icon item" @click="fetchSites(pagination.next_page_url)">
                        <i class="right chevron icon"></i>
                    </li>
                </div>
                </th>
            </tr></tfoot>
        </table>

        <div class="ui modal scale">
            <div class="header">Add New Site Record</div>
            <div class="content">
                <form @submit.prevent="addSite()" class="ui form">
                    <div class="field">
                        <label for="">Site ID</label>
                        <input type="text" v-model="site.site_id">
                    </div>
                    <div class="field">
                        <label for="">Site Name</label>
                        <input type="text" v-model="site.name">
                    </div>
                    <div class="field">
                        <label for="">Type</label>
                        <select v-model="site.type">
                            <option value="tower">Tower</option>
                            <option value="telkom">Telkom</option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="">Location</label>
                        <input type="text" v-model="site.lokasi">
                    </div>
                    <div class="field">
                        <label for="">Site Description</label>
                        <textarea cols="30" rows="10" v-model="site.description"></textarea>
                    </div>
                    <button class="ui button">Add</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    metaInfo: {
        title: 'Site Management'
    },
    data() {
        return {
            sites: [],
            site: {
                site_id: '',
                site_name: '',
                location: ''
            },
            id: '',
            pagination: {},
            edit: false,
            checked: false,
        }
    },
    created() {
        this.fetchSites();
    },
    methods: {
        fetchSites(page_url) {
            let st = this
            page_url = page_url || this.$api + 'site'
            fetch(page_url)
            .then(res => res.json())
            .then(res => {
                this.sites = res.data
                st.makePagination(res.meta, res.links)
            }).catch(err => console.log(err))
        },
        makePagination(meta, links) {
            let pagination = {
                current_page: meta.current_page,
                last_page: meta.last_page,
                next_page_url: links.next,
                prev_page_url: links.prev
            }

            this.pagination = pagination
        },
        deleteSite(id) {
            if(confirm('Are you sure?')) {
                fetch(this.$api + 'site/${id}', {
                    method: 'delete',
                })
                .then(res => res.json())
                .then(data => {
                    alert('Site removed')
                    this.fetchSites()
                })
                .catch(err => console.log(err))
            }
        },
        addSite() {
            fetch(this.$api + 'site', {
                method: 'post',
                body: JSON.stringify(this.site),
                headers: {
                    'content-type': 'application/json',
                    'token_type': 'Bearer',
                }
            })
            .then(res => res.json())
            .then(data => {
                this.site_id = ''
                this.site.name = ''
                this.site.type = ''
                this.site.lokasi = ''
                this.site.description = ''
                alert('Site Added')
                this.fetchSites()
            })
        },
        // toggleChecked() {
        //     this.checked = !this.checked
        // },
        addModal() {
            $('.modal').modal('show')
            // $('.modal').modal({ closable: true })
        }
    }
}

</script>

<style>

</style>
