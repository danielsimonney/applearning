<template>
  <div>
    <p>
      Commented {{ comment.created_at }}
    </p>
    <p>
      {{ comment.body }}
    </p>
  </div>
</template>

<script>
export default {
props:{
   comment:{
      type:Object,
      default:null,
    },
},
// async asyncData({$axios}) {
//       try{
//           let {data,links} = await $axios.$get('/topics')
//           console.log(data[0].posts[11])
//           return{
//             topics:data,
//             links
//           }
//           }catch(err) {
//         console.log(err)
//           }
//     },
mounted(){
  console.log(this.comment)
}
}
</script>

<style>

</style>