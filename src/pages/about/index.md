---
templateKey: about-page
path: /about
title: nick.steal
---
```
nick.steal.title : Занималка ников by Сука

nick.steal.licencekey : 1FFD755BEEDF5CA072E9AF1BB0FBC09693BFC3984D2A0C7DA1D1C8BC3D901041#30422319DCC296BA8DDFC231CF24C0618D64053E758AA7DEE19A045B3D2D857F

nick.steal.transfer.form.component : false

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