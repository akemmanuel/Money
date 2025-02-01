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

