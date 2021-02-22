import tweepy
import datetime

def gettwitterdata(keyword,dfile):

    #python で Twitter APIを使用するためのConsumerキー、アクセストークン設定
    Consumer_key = 'fmg8i85xa4zBmJtXA201JZTH6'
    Consumer_secret = 'gjXCqHIdhtOwQZJW6KAMfIzaRXauULDHXdVCO9ql9tL6AKfhMG'
    Access_token = '3185158440-vOFHYc5cuPae13T2aks9ahWts9bHgivE5M2G8zq'
    Access_secret = '21LQNC0Dwnd12eVV5SdGhtFzf3ghczKCiwmD0y09tnytH'

    #認証
    auth = tweepy.OAuthHandler(Consumer_key, Consumer_secret)
    auth.set_access_token(Access_token, Access_secret)

    api = tweepy.API(auth, wait_on_rate_limit = True)

    #検索キーワード設定 
    q = keyword

    #つぶやきを格納するリスト
    tweets_data =[]

    #カーソルを使用してデータ取得
    for tweet in tweepy.Cursor(api.search, q=q, count=100,tweet_mode='extended').items():

        #つぶやき時間がUTCのため、JSTに変換  ※デバック用のコード
        #jsttime = tweet.created_at + datetime.timedelta(hours=9)
        #print(jsttime)

        #つぶやきテキスト(FULL)を取得
        tweets_data.append(tweet.full_text + '\n')


    #出力ファイル名
    fname = r"'"+ dfile + "'"
    fname = fname.replace("'","")

    #ファイル出力
    with open(fname, "w",encoding="utf-8") as f:
        f.writelines(tweets_data)


if __name__ == '__main__':

    #検索キーワードを入力  ※リツイートを除外する場合 「キーワード -RT 」と入力
    print ('====== Enter Serch KeyWord   =====')
    keyword = input('>  ')

    #出力ファイル名を入力(相対パス or 絶対パス)
    print ('====== Enter Tweet Data file =====')
    dfile = input('>  ')

    gettwitterdata(keyword,dfile)
