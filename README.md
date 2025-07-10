

# 🗺️ Geolocation Project with PostgreSQL 16 + PostGIS 3

## Overview

This project uses **PostgreSQL 16** with the **PostGIS 3** extension to handle spatial and geolocation data, such as coordinates, areas, distances, and shapes. It is suitable for use cases like:

* Tracking user or asset locations
* Geo-fencing and area-based services
* Location-based search (e.g. "nearest X")
* Mapping and GIS applications
* Spatial analytics

---

## 📦 Requirements

* Ubuntu 22.04 or newer
* PostgreSQL 16
* PostGIS 3 extension
* Optional: Backend framework (Laravel, Node.js, Django, etc.)

---

## 🛠️ Installation Guide

### Step 1: Add PostgreSQL APT Repository

```bash
echo "deb http://apt.postgresql.org/pub/repos/apt $(lsb_release -cs)-pgdg main" | sudo tee /etc/apt/sources.list.d/pgdg.list
```

### Step 2: Import PostgreSQL GPG Key

```bash
wget --quiet -O - https://www.postgresql.org/media/keys/ACCC4CF8.asc | sudo apt-key add -
```

### Step 3: Update Package List

```bash
sudo apt update
```

### Step 4: Install PostgreSQL 16 with PostGIS 3

```bash
sudo apt install postgresql-16-postgis-3
```

---

## 📂 Create a Spatial Database

### Step 1: Create Database & User (optional)

```bash
sudo -u postgres psql
```

```sql
-- Inside psql shell:
CREATE DATABASE geo_db;
\c geo_db
CREATE EXTENSION postgis;
CREATE EXTENSION postgis_topology;
```

> ✅ `postgis` adds geometry types & functions
> ✅ `postgis_topology` adds topological support (optional)

---

## 🔍 Example Queries

```sql
-- Create a table with a geometry column
CREATE TABLE locations (
    id SERIAL PRIMARY KEY,
    name VARCHAR,
    geom GEOGRAPHY(POINT, 4326) -- Latitude & Longitude in WGS84
);

-- Insert a sample point (longitude, latitude)
INSERT INTO locations (name, geom)
VALUES ('Test Location', ST_GeogFromText('SRID=4326;POINT(51.389 35.6892)'));

-- Find all locations within 10km of a given point
SELECT *
FROM locations
WHERE ST_DWithin(
    geom,
    ST_MakePoint(51.4, 35.7)::geography,
    10000 -- meters
);
```

---

## 🧪 Useful Commands

```bash
# Connect to database
psql -U postgres -d geo_db

# List installed extensions
\dx

# List geometry columns
SELECT * FROM geometry_columns;
```

---

## 🌍 Coordinate System Used

* **SRID 4326** (WGS84)

    * Latitude/Longitude in degrees
    * Globally recognized standard used by GPS

---

## 🧠 Tips

* Always specify `SRID=4326` when working with geographic coordinates.
* Use `GEOGRAPHY` type for great-circle distance queries (meters).
* Use `GEOMETRY` type if you need planar calculations (x/y).

---

## 🔒 Security Note

Never expose your PostgreSQL server publicly without proper authentication, SSL, and firewall settings.


sudo apt install postgresql-16-postgis-3