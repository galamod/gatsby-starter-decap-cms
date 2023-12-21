---
templateKey: about-page
path: /about
title: nick.steal
---
```
nick.steal.title : Занималка ников by Сука

nick.steal.licencekey : F6365F378948D2BA3E24661A0CF172B5695523C4BF151059B3826FC5BDC4B1B1

nick.steal.transfer.form.component : true

nick.steal.direct.url : https://galaxy.mobstudio.ru/services/?userID=USER_ID_VALUE&password=USER_PASS_VALUE&a=change_user_nick&nick=&usercur=USER_ID_VALUE&random=RANDOM_VALUE

nick.steal.registration.url : https://galaxy.mobstudio.ru/services/?userID=0&password=&a=registration_register&age_confirmed=1&random=RANDOM_VALUE

nick.steal.checkAndBorrow.url : https://galaxy.mobstudio.ru/services/?userID=USER_ID_VALUE&password=USER_PASS_VALUE&a=user_selector&random=RANDOM_VALUE

nick.steal.checkAndBorrow.pattern : <td[^>]*>([^<]+)(?:<[^>]+>)?.*<\/td>
```

```csharp
        public async Task AutoReg()
        {
            try
            {
                do
                {
                    var randomProxy = proxyList.GetRandomProxy();
                    string randomHead = await RandomHead();
                    string randomBody = await RandomBody();
                    string randomNick = await RandomNick();
                    var randomHash = new RandomHashGenerator(32).GenerateRandomHash();

                    WebProxy proxy = new WebProxy(Host: randomProxy.IP, Port: randomProxy.Port);
                    if (!string.IsNullOrEmpty(randomProxy.Login) && !string.IsNullOrEmpty(randomProxy.Password))
                        proxy.Credentials = new NetworkCredential(userName: randomProxy.Login, password: randomProxy.Password);
                    var handler = new HttpClientHandler { Proxy = proxy };

                    using (HttpClient HTTP = new HttpClient(handler, true))
                    {
                        {
                            string userAgent = UserAgentGenerator.GetRandomMobileUserAgent();
                            Screen screen = Screen.PrimaryScreen;
                            int screenWidth = screen.Bounds.Width;
                            int screenHeight = screen.Bounds.Height;
                            string orientation = screen.Bounds.Width > screen.Bounds.Height ? "landscape" : "portrait";

                            HTTP.DefaultRequestHeaders.Add("Accept", "*/*");
                            HTTP.DefaultRequestHeaders.Add("Accept-Language", "ru-RU,ru;q=0.8,en-US;q=0.5,en;q=0.3");
                            HTTP.DefaultRequestHeaders.Add("host", "galaxy.mobstudio.ru");
                            HTTP.DefaultRequestHeaders.Add("x-galaxy-client-ver", "9.5");
                            HTTP.DefaultRequestHeaders.Add("x-galaxy-kbv", "353");
                            HTTP.DefaultRequestHeaders.Add("x-galaxy-lng", "ru");
                            HTTP.DefaultRequestHeaders.Add("x-galaxy-model", UserAgentGenerator.GetDeviceNameAndModel(userAgent));
                            HTTP.DefaultRequestHeaders.Add("x-galaxy-orientation", orientation);
                            HTTP.DefaultRequestHeaders.Add("x-galaxy-os-ver", UserAgentGenerator.GetDeviceNameAndModel(userAgent));
                            HTTP.DefaultRequestHeaders.Add("x-galaxy-platform", "ios");
                            HTTP.DefaultRequestHeaders.Add("x-galaxy-scr-dpi", GetDpiType(screenWidth).ToString());
                            HTTP.DefaultRequestHeaders.Add("x-galaxy-scr-h", screenHeight.ToString());
                            HTTP.DefaultRequestHeaders.Add("x-galaxy-scr-w", screenWidth.ToString());
                            HTTP.DefaultRequestHeaders.Add("x-galaxy-user-agent", userAgent);
                        }
                        HttpResponseMessage httpResponse = await HTTP.PostAsync($"https://galaxy.mobstudio.ru/services/?userID=0&password=&a=registration_register&age_confirmed=1&random={Random}", new FormUrlEncodedContent(new Dictionary<string, string> { { "nick", randomNick.Trim() }, { "agreement", "1" }, { "head", randomHead.Trim() }, { "body", randomBody.Trim() }, { "gender", "0" }, { "numa", randomHash }, { "defaultHeadbodyPair", "0" }, { "jad_PartID", "25" }, { "jad_userID", "null" }, { "jad_DeviceId", "" }, { "jad_locale", "ru" }, { "jad_advertisingId", "" }, { "recovery_code", "" } }));
                        var result = httpResponse.Content.ReadAsStringAsync().Result;
                        
                        string reg_pass = GetHeaderValue.String(headers: httpResponse.Headers, headerName: "x-reg-pass");
                        string reg_id = GetHeaderValue.String(headers: httpResponse.Headers, headerName: "x-reg-id");
                        string reg_nick = GetHeaderValue.String(headers: httpResponse.Headers, headerName: "x-reg-nick");

                        if (!string.IsNullOrEmpty(reg_id) && !string.IsNullOrEmpty(reg_pass))
                        {
                            Logger.Log($"Создали персонаж: [ {reg_nick} ]");
                            await Client.Connect(id: reg_id, pass: reg_pass, nick: reg_nick, passwordSave: true);
                            attempts++;
                            return;
                        }
                    }
                }
                while (attempts < 100);
                Logger.Log($"Созданное количество персонажей: {attempts}");
                Threads.Stop(AutoReg);
                Threads.StopAll();
            }
            catch
            {
            }
        }
```

```
        public async Task AutoReg()
        {
            try
            {
                string userAgent = UserAgentGenerator.GetRandomMobileUserAgent();
                Screen screen = Screen.PrimaryScreen;
                int screenWidth = screen.Bounds.Width;
                int screenHeight = screen.Bounds.Height;
                string orientation = screen.Bounds.Width > screen.Bounds.Height ? "landscape" : "portrait";

                var randomProxy = proxyList.GetRandomProxy();
                string randomHead = await RandomHead();
                string randomBody = await RandomBody();
                string randomNick = await RandomNick();
                var randomHash = new RandomHashGenerator(32).GenerateRandomHash();

                WebProxy proxy = new WebProxy(Host: randomProxy.IP, Port: randomProxy.Port);
                if (!string.IsNullOrEmpty(randomProxy.Login) && !string.IsNullOrEmpty(randomProxy.Password))
                    proxy.Credentials = new NetworkCredential(userName: randomProxy.Login, password: randomProxy.Password);

                string requestUrl = $"https://galaxy.mobstudio.ru/services/?userID=0&password=&a=registration_register&age_confirmed=1&random={Random}";

                HttpWebRequest request = (HttpWebRequest)WebRequest.Create(requestUrl);
                request.Method = "POST";
                request.Proxy = proxy;

                request.Headers.Add("Accept", "*/*");
                request.Headers.Add("Accept-Language", "ru-RU,ru;q=0.8,en-US;q=0.5,en;q=0.3");
                request.Headers.Add("host", "galaxy.mobstudio.ru");
                request.Headers.Add("x-galaxy-client-ver", "9.5");
                request.Headers.Add("x-galaxy-kbv", "353");
                request.Headers.Add("x-galaxy-lng", "ru");
                request.Headers.Add("x-galaxy-model", UserAgentGenerator.GetDeviceNameAndModel(userAgent));
                request.Headers.Add("x-galaxy-orientation", orientation);
                request.Headers.Add("x-galaxy-os-ver", UserAgentGenerator.GetDeviceVersion(userAgent));
                request.Headers.Add("x-galaxy-platform", "ios");
                request.Headers.Add("x-galaxy-scr-dpi", GetDpiType(screenWidth).ToString());
                request.Headers.Add("x-galaxy-scr-h", screenHeight.ToString());
                request.Headers.Add("x-galaxy-scr-w", screenWidth.ToString());
                request.Headers.Add("x-galaxy-user-agent", userAgent);
                request.ContentType = "application/x-www-form-urlencoded";

                string postData = $"nick=4511&agreement=1&head={randomHead.Trim()}&body={randomBody.Trim()}&gender=0&numa={randomHash}&defaultHeadbodyPair=0&jad_PartID=25&jad_userID=null&jad_DeviceId=&jad_locale=ru&jad_advertisingId=&recovery_code=";

                byte[] byteArray = Encoding.UTF8.GetBytes(postData);
                request.ContentLength = byteArray.Length;

                using (Stream requestStream = await request.GetRequestStreamAsync())
                using (StreamWriter writer = new StreamWriter(requestStream, Encoding.UTF8))
                {
                    writer.Write(postData);
                }

                using (HttpWebResponse response = (HttpWebResponse)await request.GetResponseAsync())
                using (Stream responseStream = response.GetResponseStream())
                using (StreamReader reader = new StreamReader(responseStream))
                {
                    string responseBody = reader.ReadToEnd();

                    string reg_pass = response.Headers["x-reg-pass"];
                    string reg_id = response.Headers["x-reg-id"];
                    string reg_nick = response.Headers["x-reg-nick"];
                    Logger.Log(reg_nick +" " + reg_id + " "+ reg_pass);
                    if (!string.IsNullOrEmpty(reg_id) && !string.IsNullOrEmpty(reg_pass))
                    {
                        Logger.Log($"Создали персонаж: [ {reg_nick} ]");
                        //await Client.Connect(id: reg_id, pass: reg_pass, nick: reg_nick, passwordSave: true);
                        attempts++;
                        return;
                    }
                    else if (attempts < 100)
                    {
                        Logger.Log($"Созданное количество персонажей: {attempts}");
                        Threads.Stop(AutoReg);
                        Threads.StopAll();
                    }
                }
            }
            catch (Exception ex)
            {
                Console.WriteLine("Ошибка при выполнении запроса: " + ex.Message);
            }
        }
```