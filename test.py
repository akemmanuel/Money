import requests
import matplotlib.pyplot as plt
import pandas as pd
from datetime import datetime

# Funktion zum Abrufen der Bitcoin-Daten von CryptoCompare
def fetch_bitcoin_data():
    url = "https://min-api.cryptocompare.com/data/v2/histoday"
    params = {
        'fsym': 'BTC',
        'tsym': 'USD',
        'limit': 2000,  # Maximal 2000 Datenpunkte pro Anfrage
        'toTs': int(datetime.now().timestamp())  # Aktuelles Datum
    }
    
    all_data = []
    while True:
        response = requests.get(url, params=params)
        data = response.json()
        print(data)
        if 'Data' in data and 'Data' in data['Data']:
            all_data.extend(data['Data'])
            if len(data['Data']) < 2000:
                break  # Wenn weniger als 2000 Datenpunkte zurückgegeben werden, sind wir am Ende
            params['toTs'] = data['Data'][-1]['time']  # Setze den Zeitstempel für die nächste Anfrage
        else:
            break

    return all_data

# Daten abrufen
prices = fetch_bitcoin_data()

# Daten in ein DataFrame umwandeln
df = pd.DataFrame(prices)
print(df)
df['time'] = pd.to_datetime(df['time'], unit='s')

# Plot erstellen
plt.figure(figsize=(12, 6))
plt.plot(df['time'], df['close'], label='Bitcoin Preis (USD)', color='orange')
plt.title('Bitcoin Preisverlauf von Anfang an')
plt.xlabel('Datum')
plt.ylabel('Preis in USD')
plt.xticks(rotation=45)
plt.legend()
plt.grid()
plt.tight_layout()
plt.show()

# Funktion zum Abrufen der Bitcoin-Daten
def fetch_bitcoin_data(start, end):
    url = f"https://api.coingecko.com/api/v3/coins/bitcoin/market_chart/range"
    params = {
        'vs_currency': 'usd',
        'from': start,
        'to': end,
        'interval': 'hourly'
    }
    response = requests.get(url, params=params)
    data = response.json()
    print(data)
    return data['prices']

# Zeitrahmen für die Daten (Unix-Zeit)
start_time = int(datetime(2023, 1, 1).timestamp())  # Startdatum
end_time = int(datetime.now().timestamp())  # Enddatum (jetzt)

# Daten abrufen
prices = fetch_bitcoin_data(start_time, end_time)

# Daten in ein DataFrame umwandeln
df = pd.DataFrame(prices, columns=['timestamp', 'price'])
df['timestamp'] = pd.to_datetime(df['timestamp'], unit='ms')

# Plot erstellen
plt.figure(figsize=(12, 6))
plt.plot(df['timestamp'], df['price'], label='Bitcoin Preis (USD)', color='orange')
plt.title('Bitcoin Preisverlauf')
plt.xlabel('Datum')
plt.ylabel('Preis in USD')
plt.xticks(rotation=45)
plt.legend()
plt.grid()
plt.tight_layout()
plt.show()



from cryptotools import Xpub

# Dein zpub-Schlüssel (ersetze diesen mit deinem tatsächlichen zpub)
MY_ZPUB = 'zpub6qKwM5JzZnS5HSngM3nBo4rtU1j88oY5UjHwFUePdKSWPRVzNpMk68pgteHtANWH4PRgSDsPscYtPkKFGNdbTDmu5TY1Pi91D85n6Kf4RWP'

# Den zpub-Schlüssel dekodieren
key = Xpub.decode(MY_ZPUB)

# Generiere die erste SegWit-Adresse (P2WPKH)
pubkey0 = key/0/0  # 0/0 ist der Standardindex für den ersten Schlüssel

# Gib die SegWit-Adresse aus
print(pubkey0.address('P2WPKH'))

exit()
import requests

# Bitcoin-Adresse
address = "bc1qdxa2f9wexkmy66mkedwphlazhq43jugym0zg8l"

# API-URL
url = f"https://blockchain.info/unspent?active={address}"

try:
    response = requests.get(url)
    response.raise_for_status()  # Fehler abfangen

    data = response.json()
    
    # Alle unspent transactions (UTXOs) summieren
    total_satoshi = sum(tx["value"] for tx in data["unspent_outputs"])
    
    # In BTC umrechnen (1 BTC = 100.000.000 Satoshi)
    total_btc = total_satoshi / 1e8

    print(f"Adresse: {address}")
    print(f"Aktuelles Guthaben: {total_btc:.8f} BTC")

except requests.exceptions.HTTPError as err:
    print(f"HTTP-Fehler: {err}")
except requests.exceptions.RequestException as err:
    print(f"Anfragefehler: {err}")
except KeyError:
    print("Kein Guthaben oder ungültige Antwort.")
exit()

import yfinance as yf

# Tickersymbole
gold_symbol = "GC=F"  # Gold
silver_symbol = "SI=F"  # Silber
oil_symbol = "CL=F"  # Öl (WTI)

# Abrufen der Daten
gold = yf.Ticker(gold_symbol)
silver = yf.Ticker(silver_symbol)
oil = yf.Ticker(oil_symbol)
btc = yf.Ticker("BTC-USD")

# Aktuelle Preise abrufen
current_gold_price = gold.history(period="1d")['Close'][0]
current_silver_price = silver.history(period="1d")['Close'][0]
current_oil_price = oil.history(period="1d")['Close'][0]
current_btc_price = btc.history(period="1d")['Close'][0]

print(f"Aktueller Preis von Gold: {current_gold_price} USD")
print(f"Aktueller Preis von Silber: {current_silver_price} USD")
print(f"Aktueller Preis von Öl: {current_oil_price} USD")
print(f"Aktueller Preis von Bitcoin: {current_btc_price} USD")


import ccxt
exchange = ccxt.binance()
ticker = exchange.fetch_ticker('BTC/USDT')
print(ticker)

import requests
import matplotlib.pyplot as plt
from datetime import datetime

# CoinGecko API URL für den Bitcoin-Preisverlauf
url = "https://api.coingecko.com/api/v3/coins/bitcoin/market_chart?vs_currency=usd&days=0.1"

# API-Anfrage
response = requests.get(url)

# Überprüfen, ob die Anfrage erfolgreich war
if response.status_code == 200:
    data = response.json()
    
    # Extrahieren der Preise und Zeitstempel
    prices = data['prices']
    timestamps = [datetime.fromtimestamp(price[0] / 1000) for price in prices]
    values = [price[1] for price in prices]
    
    # Plotten der Preisdaten
    plt.figure(figsize=(10, 5))
    plt.plot(timestamps, values, label='BTC/USD', color='blue')
    plt.title('Bitcoin Preisverlauf (letzte 30 Tage)')
    plt.xlabel('Datum')
    plt.ylabel('Preis in USD')
    plt.xticks(rotation=45)
    plt.legend()
    plt.grid()
    plt.tight_layout()
    plt.show()
else:
    print(f"Fehler beim Abrufen der Daten: {response.status_code}")

