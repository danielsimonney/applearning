export default function({store,redirect}) {
  if(store.getters['profile/authenticated']){
    return redirect('/dashboard')
  }
}