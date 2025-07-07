# 🌐 REACH E-learning Platform

**REACH** (Remote Education Access using Cloud and Hybrid tools) is a cloud-integrated E-learning platform designed to empower remote and rural learners by offering accessible, multilingual, and skill-based digital learning content. The platform combines powerful cloud technologies like Azure and Firebase with AI-powered features to provide a smart, scalable, and inclusive learning experience.

---

## 🚀 Features

- 🌍 **Multilingual Support** – Integrated Azure Translator to support local languages.
- 🔐 **Firebase Authentication** – Secure user authentication and session management.
- ☁️ **Cloud Database** – Firebase Realtime Database for storing course data and progress.
- 🤖 **AI Chatbot** – Azure AI-powered assistant for 24/7 learner support.
- 🧠 **AI-Powered Recommendations** – Suggests courses based on learner interests.
- 📁 **Google Drive Integration** – Upload and access course resources.
- 🗂️ **Course Catalog** – Digital Literacy, English, Finance, and more.
- 📱 **Responsive Design** – Accessible from mobile and desktop devices.

---

## 🛠️ Technologies Used

| Technology           | Purpose                                      |
|----------------------|----------------------------------------------|
| Firebase Auth        | User login, registration, session management |
| Firebase Realtime DB | Store user data, courses, progress           |
| Azure Virtual Machine| Hosting the backend services                 |
| Azure Translator     | Language translation for local support       |
| Azure Bot Services   | Smart chatbot for Q&A and guidance           |
| Google Drive API     | Upload/download course content               |
| HTML, CSS, JS        | Frontend development                         |
| Bootstrap            | UI/UX styling and responsiveness             |

---

## 🔧 Setup Instructions

### 1️⃣ Clone the Repository

```bash
git clone https://github.com/AsithJayasahan/REACH-E-Learning-Web-Application.git
cd REACH-E-Learning-Web-Application
```

### 2️⃣ Run the Laravel Backend
```bash
php artisan serve
```

### 🔐Firebase Authentication Setup

1. Go to Firebase Console
2. Create a project or use an existing one.
3. Navigate to Authentication > Sign-in method:
4. Enable Email/Password (or others like Google).
5. Add Firebase configuration in firebase.js:

```javascript
import { initializeApp } from "firebase/app";
import { getAuth } from "firebase/auth";

const firebaseConfig = {
  apiKey: "YOUR_API_KEY",
  authDomain: "YOUR_DOMAIN",
  projectId: "YOUR_PROJECT_ID",
  storageBucket: "YOUR_BUCKET",
  messagingSenderId: "YOUR_SENDER_ID",
  appId: "YOUR_APP_ID",
  databaseURL: "YOUR_DB_URL"
};

const app = initializeApp(firebaseConfig);
export const auth = getAuth(app);
```

### 🗄️ Firebase Realtime Database Setup

1. In Firebase Console, go to Realtime Database > Create Database
2. Choose "Start in test mode" (for development).
3. Sample code to store data:

```javascript
import { getDatabase, ref, set } from "firebase/database";

const db = getDatabase(app);

set(ref(db, 'users/' + userId), {
  name: "John",
  progress: 75
});
```

### 🌐 Azure Translator Setup
1. Go to Azure Portal
2. Create a Translator Resource
3. Note down:
   * Endpoint
   * Key
   * Region

4. Sample API usage:

```javascript
const axios = require("axios");

const translateText = async (text, toLang = "si") => {
  const response = await axios.post(
    "https://api.cognitive.microsofttranslator.com/translate?api-version=3.0&to=" + toLang,
    [{ Text: text }],
    {
      headers: {
        "Ocp-Apim-Subscription-Key": "YOUR_KEY",
        "Ocp-Apim-Subscription-Region": "YOUR_REGION",
        "Content-Type": "application/json"
      }
    }
  );
  console.log(response.data[0].translations[0].text);
};
```

### 🤖 Azure AI Chatbot Integration

# Step 1: Create the Bot
  1. In Azure Portal, search for Bot Channels Registration
  2. Fill in required details, and create your bot.
     
# Step 2: Build Bot with Bot Framework SDK

```javascript
const { ActivityHandler } = require("botbuilder");

class MyBot extends ActivityHandler {
  constructor() {
    super();
    this.onMessage(async (context, next) => {
      const text = context.activity.text;
      await context.sendActivity(`You said: ${text}`);
      await next();
    });
  }
}
```

# Step 3: Connect Bot to Frontend using Direct Line

```html
<script src="https://cdn.botframework.com/botframework-webchat/latest/webchat.js"></script>
<div id="webchat" role="main"></div>
<script>
  window.WebChat.renderWebChat({
    directLine: window.WebChat.createDirectLine({
      secret: 'YOUR_DIRECT_LINE_SECRET'
    }),
    userID: 'user123',
    username: 'Learner'
  }, document.getElementById('webchat'));
</script>
```

### 📁 .env Example (Firebase + Azure)

```env
FIREBASE_API_KEY=your_firebase_key
FIREBASE_AUTH_DOMAIN=your_auth_domain
FIREBASE_DATABASE_URL=your_db_url
FIREBASE_PROJECT_ID=your_project_id
FIREBASE_STORAGE_BUCKET=your_bucket
FIREBASE_MESSAGING_SENDER_ID=your_sender_id
FIREBASE_APP_ID=your_app_id

AZURE_TRANSLATOR_KEY=your_translator_key
AZURE_TRANSLATOR_REGION=your_region
AZURE_TRANSLATOR_ENDPOINT=https://api.cognitive.microsofttranslator.com

AZURE_BOT_DIRECT_LINE_SECRET=your_bot_directline_secret
```
