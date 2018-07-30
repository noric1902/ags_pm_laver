<template>
    <div>

    </div>
</template>

<script>
export default {
    created() {
        this.fetchSubmissions()
    },
    metaInfo: {
        title: 'Submission Request'
    },
    data: {
        submissions: {
            
        },
        loading: false
    },
    methods: {
        fetchSubmissions() {
            this.loading = true
            this.axios({
                method: 'get',
                url: this.$api + 'pengajuan'
            })
            .then(res => {
                console.log(res.data)
            })
            .catch(err => {
                console.log(err)
            })
        }
    }
}
</script>

<style>

</style>
