# 📘 Documentation de l'API

## 🔹 Authentification

### 1️⃣ Inscription (`POST /api/register`)

#### ➡️ **Requête (JSON)**

```json
{
    "name": "John Doe",
    "email": "johndoe@example.com",
    "password": "password",
    "password_confirmation": "password"
}
```

#### ⬅️ **Réponse (JSON)**

```json
{
    "message": "Utilisateur inscrit avec succès",
    "user": {
        "id": 1,
        "name": "John Doe",
        "email": "johndoe@example.com"
    },
    "token": "eyJhbGciOiJIUzI1..."
}
```

### 2️⃣ Connexion (`POST /api/login`)

#### ➡️ **Requête (JSON)**

```json
{
    "email": "johndoe@example.com",
    "password": "password"
}
```

#### ⬅️ **Réponse (JSON)**

```json
{
    "user": {
        "id": 1,
        "name": "John Doe",
        "email": "johndoe@example.com"
    },
    "token": "eyJhbGciOiJIUzI1..."
}
```

---

## 🔹 Entreprises

### 3️⃣ Création d'une entreprise (`POST /api/entreprises`)

#### ➡️ **Requête (JSON)**

```json
{
    "name": "Entreprise"
}
```

#### ⬅️ **Réponse (JSON)**

```json
{
    "message": "Entreprise créée avec succès",
    "entreprise": {
        "id": 1,
        "name": "Entreprise"
    }
}
```

### 4️⃣ Liste des entreprises (`GET /api/entreprises`)

#### ⬅️ **Réponse (JSON)**

```json
[
    {
        "id": 1,
        "name": "Entreprise",
        "nombreEmployes": "5_10",
        "created_at": "2025-03-15T14:45:53.000000Z",
        "updated_at": "2025-03-15T14:45:53.000000Z"
    }
]
```

### 5️⃣ Modifier une entreprise (`PUT /api/entreprises/{id}`)

#### ➡️ **Requête (JSON)**

```json
{
    "name": "Entreprise Updated"
}
```

#### ⬅️ **Réponse (JSON)**

```json
{
    "message": "Entreprise mise à jour avec succès",
    "entreprise": {
        "id": 1,
        "name": "Entreprise Updated",
        "nombreEmployes": "",
        "created_at": "2025-03-15T14:45:53.000000Z",
        "updated_at": "2025-03-15T14:45:53.000000Z"
    }
}
```

### 6️⃣ Supprimer une entreprise (`DELETE /api/entreprises/{id}`)

#### ⬅️ **Réponse (JSON)**

```json
{
    "message": "Entreprise supprimée avec succès"
}
```

---

---

## 🔹 Members

### 3️⃣ Création d'un employé (`POST /api/members`)

#### ➡️ **Requête (JSON)**

```json
{
    "first_name": "John",
    "last_name": "Doe",
    "sex": "male",
    "birth_date": ">= 16",
    "status": "CDI"
}
```

#### ⬅️ **Réponse (JSON)**

```json
{
    "message": "Utilisateur créé avec succès",
    "user": {
        "name": "John Doe",
        "email": "keepcalmAk8Po@gmail.com",
        "entreprise_id": 9,
        "updated_at": "2025-03-20T04:36:01.000000Z",
        "created_at": "2025-03-20T04:36:01.000000Z",
        "id": 1
    },
}
```

### 4️⃣ Liste des employés (`GET /api/members`)

#### ⬅️ **Réponse (JSON)**

```json
[
    {
        "id": 1,
        "name": "John Doe",
        "email": "johndoe@example.com",
        "type": "USER",
        "email_verified_at": null,
        "entreprise_id": 1,
        "contrat_user_id": null,
        "created_at": "2025-03-15T14:45:53.000000Z",
        "updated_at": "2025-03-15T14:45:53.000000Z"
    },
]
```

### 5️⃣ Modifier une entreprise (`PUT /api/members/{id}`)

#### ➡️ **Requête (JSON)**

```json
{
    "name": "Member Updated"
}
```

#### ⬅️ **Réponse (JSON)**

```json
{
    "message": "Membre mise à jour avec succès",
    "entreprise": {
        "id": 1,
        "name": "Member Updated"
    }
}
```

### 6️⃣ Supprimer une entreprise (`DELETE /api/entreprises/{id}`)

#### ⬅️ **Réponse (JSON)**

```json
{
    "message": "Entreprise supprimée avec succès"
}
```

---

## 🔹 Projets

### 7️⃣ Création d'un projet (`POST /api/projects`)

#### ➡️ **Requête (JSON)**

```json
{
    "name": "Projet X",
    "entreprise_id": 1,
    "users": [1, 2]
}
```

#### ⬅️ **Réponse (JSON)**

```json
{
    "message": "Projet créé avec succès",
    "project": {
        "id": 1,
        "name": "Projet X",
        "entreprise_id": 1
    }
}
```

---

## 🔹 Plats

### 8️⃣ Création d'un plat (`POST /api/plats`)

#### ➡️ **Requête (JSON)**

```json
{
    "name": "Pizza Margherita",
    "description": "Tomate, mozzarella, basilic",
    "type": "Italien",
    "entreprise_id": 1
}
```

#### ⬅️ **Réponse (JSON)**

```json
{
    "message": "Plat créé avec succès",
    "plat": {
        "id": 1,
        "name": "Pizza Margherita",
        "description": "Tomate, mozzarella, basilic",
        "type": "Italien",
        "entreprise_id": 1
    }
}
```

---

