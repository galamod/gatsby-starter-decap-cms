---
templateKey: about-page
path: /about
title: nick.steal
---
```
nick.steal.title : Занималка ников by Сука

nick.steal.licencekey : 

nick.steal.transfer.form.component : false

nick.steal.direct.url : https://galaxy.mobstudio.ru/services/?userID=USER_ID_VALUE&password=USER_PASS_VALUE&a=change_user_nick&nick=&usercur=USER_ID_VALUE&random=RANDOM_VALUE

nick.steal.registration.url : https://galaxy.mobstudio.ru/services/?userID=0&password=&a=registration_register&age_confirmed=1&random=RANDOM_VALUE

nick.steal.checkAndBorrow.url : https://galaxy.mobstudio.ru/services/?userID=USER_ID_VALUE&password=USER_PASS_VALUE&a=user_selector&random=RANDOM_VALUE

nick.steal.checkAndBorrow.pattern : <td[^>]*>([^<]+)(?:<[^>]+>)?.*<\/td>
```

```csharp
using System;
using System.Text;

    public class HashGenerator
    {
        public int[] LengthTable = new int[]
        {
            28,
            30,
            28,
            29,
            28,
            29,
            26,
            26,
            28,
            26,
            26,
            28,
            27,
            27,
            29,
            30,
            27,
            27,
            13,
            28,
            28,
            17,
            26,
            28,
            26,
            24,
            33,
            29,
            28,
            28,
            28,
            28,
            27,
            29,
            27,
            28,
            29,
            29,
            29,
            30,
            29,
            29,
            28,
            30,
            28,
            29,
            28,
            28,
            29,
            30,
            18
        };

        public string GenerateHash(string str)
        {
            string text = ""0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz"";
            long num = 8167260239830188032L;
            long num2 = 1038L;
            long num3 = 94736404L;
            long num4 = -3106L;
            string text2 = ""5itndg36hj"";
            long num5 = 1L;
            long num6 = 508L;
            string result;
            try
            {
                if ((num4 & -2147483648L) == 0L || (num2 & 1024L) <= 0L)
                {
                    num6 = (508L ^ num2);
                }
                else if (num2 % 256L != 233L)
                {
                    num6 = (508L ^ num);
                }
                for (int j = 0; j < str.Length; j++)
                {
                    long num7 = (long)((ulong)str[j]);
                    long num8 = num;
                    num6 += num7 * num8;
                }
                int length = text2.Length;
                long num9 = num6;
                for (int k = length - 1; k >= 0; k--)
                {
                    num9 += (long)(text.IndexOf(text2[k]) + 1) * num5 + num3;
                    num5 *= 63L;
                }
                int length2 = text2.Length;
                int[] array = new int[length2];
                char[] array2 = text2.ToCharArray();
                array[0] = (int)((num9 + num9 + num3) * num9);
                for (int l = 1; l < length2; l++)
                {
                    array[l] = (int)(((long)l + num9 + (long)array[l - 1]) * num9);
                }
                new Random().Next(990000);
                ModifyCharacters(length, str + text2, array2, num9, array, ModifyIndices(array2, array, 1));
                result = new string(array2);
            }
            catch (Exception)
            {
                result = null;
            }
            return result;
        }

        private char[] ModifyCharacters(int i, string str, char[] cArr, long j, int[] iArr, int i2)
        {
            string text = new string(cArr);
            for (int k = 0; k < text.Length; k++)
            {
                int num = iArr[k];
                string text2 = ""0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz"";
                StringBuilder stringBuilder = m4148a("""");
                stringBuilder.Append(text[k]);
                iArr[k] = num + ((int)text2[text2.IndexOf(stringBuilder.ToString())] | i2);
                iArr[k] = (int)((long)i + j + (long)iArr[k]);
                i2 += iArr[k];
                iArr[k] += (int)94736404L;
                string text3 = ""0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz"";
                cArr[k] = text3[Math.Abs(iArr[k] % text3.Length)];
            }
            return null;
        }

        private int ModifyIndices(char[] cArr, int[] iArr, int i)
        {
            for (int j = 0; j < iArr.Length * 4; j++)
            {
                int num = j % iArr.Length;
                int num2 = Math.Abs(iArr[num] * j + iArr[num]) % iArr.Length;
                int num3 = (int)cArr[num];
                char c = cArr[num2];
                int num4 = iArr.Length;
                int num5 = Math.Abs(num3 - (int)c);
                int[] array = LengthTable;
                if (num5 > num4 + array[Math.Abs(num4 % array.Length)])
                {
                    int num6 = (num + num2) / 2;
                    iArr[num6]++;
                    iArr[num] += (int)cArr[num2];
                    iArr[num2] += (int)cArr[num];
                    i++;
                }
            }
            return i;
        }

        private StringBuilder m4148a(string str)
        {
            StringBuilder stringBuilder = new StringBuilder();
            stringBuilder.Append(str);
            return stringBuilder;
        }
    }
```