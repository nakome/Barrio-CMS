const element = document.querySelector('#meet');
const domain = 'meet.jit.si';
const options = {
  roomName: 'tontunas',
  width: '100%',
  height: 600,
  parentNode: element,
  userInfo: {
    email: 'email@jitsiexamplemail.com',
    displayName: 'John Doe'
  }
};
const api = new JitsiMeetExternalAPI(domain, options);